<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaseModel\StoreCaseModelRequest;
use App\Http\Requests\CaseModel\UpdateCaseModelRequest;
use App\Http\Resources\CaseModelResource;
use App\Models\CaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class CaseModelController extends Controller {
    public function index() {
        Gate::authorize('viewAny',CaseModel::class);
        $query = $this->query();
        $cases = request('perPage')
            ? $query->paginate(request('perPage'))
            : $query->get();
        return CaseModelResource::collection($cases);
    }
    public function store(StoreCaseModelRequest $request) {
        Gate::authorize('create',CaseModel::class);
        $userAuth = Auth::guard('api')->user();
        $lawyersArray = User::whereRole('lawyer')->pluck('id')->toArray();
        $data = $request->validated();
        if($userAuth->role === 'lawyer')
            $data['lawyer_id'] = $userAuth->id;
        if($userAuth->role === 'secretary')
            $data['lawyer_id'] = $userAuth->lawyer_id;
        if(!in_array($data['lawyer_id'],$lawyersArray))
            abort(403,'El abogado asignado no tiene rol de abogado');
        $case = CaseModel::create($data);
        return CaseModelResource::make($case);
    }
    public function show(CaseModel $case) {
        Gate::authorize('view',$case);
        return CaseModelResource::make($case);
    }
    public function update(UpdateCaseModelRequest $request, CaseModel $case) {
        Gate::authorize('update',$case);
        $userAuth = Auth::guard('api')->user();
        $lawyersArray = User::whereRole('lawyer')->pluck('id')->toArray();
        $data = $request->validated();
        if($userAuth->role === 'lawyer')
            $data['lawyer_id'] = $userAuth->id;
        if($userAuth->role === 'secretary')
            $data['lawyer_id'] = $userAuth->lawyer_id;
        if(!in_array($data['lawyer_id'],$lawyersArray))
            abort(403,'El abogado asignado no tiene rol de abogado');
        $case->update($data);
        return CaseModelResource::make($case);
    }
    public function destroy(CaseModel $case) {
        Gate::authorize('delete',$case);
        $case->delete();
        return response()->noContent();
    }
    public function restore(CaseModel $case){
        Gate::authorize('restore',$case);
        $case->restore();
        return CaseModelResource::make($case);
    }
    public function forceDelete(CaseModel $case){
        Gate::authorize('forceDelete',$case);
        $case->forceDelete();
        return response()->noContent();
    }
    private function query():Builder{
        $query = CaseModel::query();
        $userAuth = Auth::guard('api')->user();
        if($userAuth->role === 'lawyer')
            $query->where('lawyer_id',$userAuth->id);
        if($userAuth->role === 'secretary')
            $query->where('lawyer_id',$userAuth->lawyer_id);
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
