<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\CaseModel;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class EventController extends Controller {
    public function index() {
        Gate::authorize('viewAny',Event::class);
        $query = $this->query();
        $events = request('perPage')
            ? $query->paginate(request('perPage'))
            : $query->get();
        return EventResource::collection($events);
    }
    public function store(StoreEventRequest $request) {
        Gate::authorize('create',Event::class);
        $userAuth = Auth::guard('api')->user();
        $data = $request->validated();
        if(empty($data['end_date']))
            $data['end_date'] = Carbon::parse($data['start_date'])->addHour();
        if($data['event_type'] === 'audience' && empty($data['meeting_link']))
            abort(403,'Debe colocar el link de la audiencia');
        if(in_array($userAuth->role,['lawyer','secretary'])){
            $lawyer = $userAuth->role === 'lawyer'
                ? $userAuth->id
                : $userAuth->lawyer_id;
            $caseIds = CaseModel::whereLawyerId($lawyer)->pluck('id')->toArray();
            if(!empty($data['case_id']) && !in_array($data['case_id'], $caseIds))
                abort(403,'Seleccione un expediente del Abogado por favor');
        }
        $data['created_by'] = $userAuth->id;
        $event = Event::create($data);
        return EventResource::make($event);
    }
    public function show(Event $event) {
        Gate::authorize('view',$event);
        return EventResource::make($event);
    }
    public function update(UpdateEventRequest $request, Event $event) {
        Gate::authorize('update',$event);
        $userAuth = Auth::guard('api')->user();
        $data = $request->validated();
        if(empty($data['end_date']))
            $data['end_date'] = Carbon::parse($data['start_date'])->addHour();
        if($data['event_type'] === 'audience' && empty($data['meeting_link']))
            abort(403,'Debe colocar el link de la audiencia');
        if(in_array($userAuth->role,['lawyer','secretary'])){
            $lawyer = $userAuth->role === 'lawyer'
                ? $userAuth->id
                : $userAuth->lawyer_id;
            $caseIds = CaseModel::whereLawyerId($lawyer)->pluck('id')->toArray();
            if(!empty($data['case_id']) && !in_array($data['case_id'], $caseIds))
                abort(403,'Seleccione un expediente del Abogado por favor');
        }
        $data['created_by'] = $userAuth->id;
        $event->update($data);
        return EventResource::make($event);
    }
    public function destroy(Event $event) {
        Gate::authorize('delete',$event);
        $event->delete();
        return response()->noContent();
    }
    public function restore(Event $event) {
        Gate::authorize('restore',$event);
        $event->restore();
        return EventResource::make($event);
    }
    public function forceDelete(Event $event) {
        Gate::authorize('forceDelete',$event);
        $event->forceDelete();
        return response()->noContent();
    }
    private function query():Builder{
        $query = Event::query();
        $userAuth = Auth::guard('api')->user();
        if(in_array($userAuth->role,['lawyer','secretary'])){
            $lawyer = $userAuth->role === 'lawyer'
                ? $userAuth->id
                : $userAuth->lawyer_id;
            $caseIds = CaseModel::whereLawyerId($lawyer)->pluck('id');
            $query->whereIn('case_id',$caseIds)
                ->orWhere('created_by',$userAuth->id);
        }
        if(request('filters')){
            foreach (request('filters') as $column => $conditions) {
                foreach ($conditions as $operator => $value) {
                    match ($operator) {
                        'like' => $query->where($column,'like',"%$value%"),
                        '!=','=','<','<=','>','>=' => $query->where($column,$operator,$value),
                    };
                }
            }
        }
        if(request('select'))
            $query->select(explode(',',request('select')));
        if(request('sort')){
            foreach (explode(',',request('sort')) as $column) {
                $direction = str_starts_with($column,'-') ? 'desc' : 'asc';
                $column = ltrim($column,'-');
                $query->orderBy($column,$direction);
            }
        }
        if(request('include'))
            $query->with(explode(',',request('include')));
        return $query;
    }
}
