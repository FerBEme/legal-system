<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Specialty\StoreSpecialtyRequest;
use App\Http\Requests\Specialty\UpdateSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class SpecialtyController extends Controller {
    public function index() {
        Gate::authorize('viewAny',Specialty::class);
        $query = $this->query();
        $specialties = request('perPage')
            ? $query->paginate(request('perPage'))
            : $query->get();
        return SpecialtyResource::collection($specialties);
    }
    public function store(StoreSpecialtyRequest $request) {
        Gate::authorize('create',Specialty::class);
        $userAuth = Auth::guard('api')->user();
        $lawyersArray = User::whereRole('lawyer')->pluck('id')->toArray();
        $data = $request->validated();
        if(!empty($data['parent_id'])){
            $levelPadre = Specialty::whereId($data['parent_id'])->first()->level;
            $data['level'] = $levelPadre + 1;
        }
        if($userAuth->role === 'lawyer')
            $data['lawyers'] = $userAuth->id;
        if(!empty($data['lawyers']) && !in_array($data['lawyers'],$lawyersArray))
            abort(403,'Debe escoger a los abogados del sistema');
        $lawyers = $data['lawyers'] ?? [];
        unset($data['lawyers']);
        $specialty = Specialty::create($data);
        if($specialty->level !== 3)
            abort(403,'Solamente se pueden cruzar lo de level 3');        
        $specialty->lawyers()->sync($lawyers);
        if($userAuth->role === 'admin') return SpecialtyResource::make($specialty->load(['mainBranch','lawyers']));
        if($userAuth->role === 'lawyer') return SpecialtyResource::make($specialty->load('mainBranch'));
    }
    public function show(Specialty $specialty) {
        Gate::authorize('view',$specialty);
        $userAuth = Auth::guard('api')->user();
        if($userAuth->role === 'admin') return SpecialtyResource::make($specialty->load(['mainBranch','lawyers']));
        if($userAuth->role === 'lawyer') return SpecialtyResource::make($specialty->load('mainBranch'));
    }
    public function update(UpdateSpecialtyRequest $request, Specialty $specialty) {
        Gate::authorize('update',$specialty);
        $userAuth = Auth::guard('api')->user();
        $lawyersArray = User::whereRole('lawyer')->pluck('id')->toArray();
        $data = $request->validated();
        if(!empty($data['parent_id'])){
            $levelPadre = Specialty::whereId($data['parent_id'])->first()->level;
            $data['level'] = $levelPadre + 1;
        }
        if($userAuth->role === 'lawyer')
            $data['lawyers'] = $userAuth->id;
        if(!empty($data['lawyers']) && !in_array($data['lawyers'],$lawyersArray))
            abort(403,'Debe escoger a los abogados del sistema');
        $lawyers = $data['lawyers'] ?? [];
        unset($data['lawyers']);
        $specialty->update($data);
        if($specialty->level !== 3)
            abort(403,'Solamente se pueden cruzar lo de level 3');        
        $specialty->lawyers()->sync($lawyers);
        if($userAuth->role === 'admin') return SpecialtyResource::make($specialty->load(['mainBranch','lawyers']));
        if($userAuth->role === 'lawyer') return SpecialtyResource::make($specialty->load('mainBranch'));
    }
    public function destroy(Specialty $specialty) {
        Gate::authorize('delete',$specialty);
        $specialty->delete();
        return response()->noContent();
    }
    public function restore(Specialty $specialty) {
        Gate::authorize('restore',$specialty);
        $specialty->restore();
        return SpecialtyResource::make($specialty->load(['mainBranch','lawyers']));
    }
    public function forceDelete(Specialty $specialty) {
        Gate::authorize('forceDelete',$specialty);
        $specialty->forceDelete();
        return response()->noContent();
    }
    private function query():Builder{
        $query = Specialty::query();
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