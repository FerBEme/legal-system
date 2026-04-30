<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    public function index() {
        Gate::authorize('viewAny',User::class);
        $query = $this->query();
        $users = request('perPage')
            ? $query->paginate(request('perPage'))
            : $query->get();
        return UserResource::collection($users);
    }
    public function store(StoreUserRequest $request) {
        Gate::authorize('create',User::class);
        $userAuth = Auth::guard('api')->user();
        $lawyers = User::whereRole('lawyer')->pluck('id')->toArray();
        $tuitionNumbers = User::where('tuition_number','!=',null)->pluck('id')->toArray();
        $data = $request->validated();
        if($request->hasFile('profile_photo'))
            $data['profile_photo'] = Storage::put('images',$request->file('profile_photo'));
        if($userAuth->role === 'lawyer'){
            $data['role'] = 'secretary';
            $data['tuition_number'] = null;
            $data['lawyer_id'] = $userAuth->id;
        }
        else{
            if($data['role'] === 'admin'){
                $data['tuition_number'] = null;
                $data['lawyer_id'] = null;
            } elseif($data['role'] === 'lawyer'){
                if($data['tuition_number'] === null)
                    abort(403,'El campo de Colegiatura es obligatorio');
                else if(in_array($data['tuition_number'],$tuitionNumbers))
                    abort(403,'Ya existe esa Colegiatura en el Sistema');
                $data['lawyer_id'] = null;
            } else {
                $data['tuition_number'] = null;
                if($data['lawyer_id'] === null)
                    abort(403,'El campo de Abogado Asignado es obligatorio');
                else if(!in_array($data['lawyer_id'],$lawyers))
                    abort(403,'Ese abogado no existe en el sistema');
            }
        }
        $user = User::create($data);
        if($userAuth->role === 'admin') return UserResource::make($user->load('lawyer'));
        if($userAuth->role === 'lawyer') return UserResource::make($user);
    }
    public function show(User $user) {
        Gate::authorize('view',$user);
        $userAuth = Auth::guard('api')->user();
        if($userAuth->role === 'admin') return UserResource::make($user->load('lawyer'));
        if($userAuth->role === 'lawyer') return UserResource::make($user);
    }
    public function update(UpdateUserRequest $request, User $user) {
        Gate::authorize('update',$user);
        $userAuth = Auth::guard('api')->user();
        $lawyers = User::whereRole('lawyer')->pluck('id')->toArray();
        $tuitionNumbers = User::where('tuition_number','!=',null)
            ->where('tuition_number','!=',$user->tuition_number)->pluck('tuition_number')->toArray();
        $data = $request->validated();
        if($request->hasFile('profile_photo')){
            if($user->profile_photo)
                Storage::delete($user->profile_photo);
            $data['profile_photo'] = Storage::put('images',$request->file('profile_photo'));
        }
        if($userAuth->role === 'lawyer'){
            $data['role'] = 'secretary';
            $data['tuition_number'] = null;
            $data['lawyer_id'] = $userAuth->id;
        }
        else{
            if($data['role'] === 'admin'){
                $data['tuition_number'] = null;
                $data['lawyer_id'] = null;
            } elseif($data['role'] === 'lawyer'){
                if($data['tuition_number'] === null)
                    abort(403,'El campo de Colegiatura es obligatorio');
                else if(in_array($data['tuition_number'],$tuitionNumbers))
                    abort(403,'Ya existe esa Colegiatura en el Sistema');
                $data['lawyer_id'] = null;
            } else {
                $data['tuition_number'] = null;
                if($data['lawyer_id'] === null)
                    abort(403,'El campo de Abogado Asignado es obligatorio');
                else if(!in_array($data['lawyer_id'],$lawyers))
                    abort(403,'Ese abogado no existe en el sistema');
            }
        }
        $user->update($data);
        if($userAuth->role === 'admin') return UserResource::make($user->load('lawyer'));
        if($userAuth->role === 'lawyer') return UserResource::make($user);
    }
    public function destroy(User $user) {
        Gate::authorize('delete',$user);
        $user->delete();
        return response()->noContent();
    }
    public function restore(User $user){
        Gate::authorize('restore',$user);
        $userAuth = Auth::guard('api')->user();
        $user->restore();
        if($userAuth->role === 'admin') return UserResource::make($user->load('lawyer'));
        if($userAuth->role === 'lawyer') return UserResource::make($user);
    }
    public function forceDelete(User $user){
        Gate::authorize('forceDelete',$user);
        $user->forceDelete();
        return response()->noContent();
    }
    private function query():Builder{
        $query = User::query();
        $userAuth = Auth::guard('api')->user();
        $query->where('id','!=',$userAuth->id);
        if($userAuth->role === 'lawyer')
            $query->where('lawyer_id',$userAuth->id);
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