<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Folder\StoreFolderRequest;
use App\Http\Requests\Folder\UpdateFolderRequest;
use App\Http\Resources\FolderResource;
use App\Models\CaseModel;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class FolderController extends Controller {
    public function index() {
        Gate::authorize('viewAny',Folder::class);
        $query = $this->query();
        $folders = request('perPage')
            ? $query->paginate(request('perPage'))
            : $query->get();
        return FolderResource::collection($folders);
    }
    public function store(StoreFolderRequest $request) {
        Gate::authorize('create',Folder::class);
        $userAuth = Auth::guard('api')->user();
        $data = $request->validated();
        if($userAuth->role === 'lawyer')
            $casesArray = CaseModel::WhereLawyerId($userAuth->id)->pluck('id')->toArray();
            if(!in_array($data['case_id'],$casesArray))
                abort(403,'Debes escoger los casos que el abogado mismo esta llevando');
        if($userAuth->role === 'secretary')
            $casesArray = CaseModel::WhereLawyerId($userAuth->lawyer_id)->pluck('id')->toArray();
            if(!in_array($data['case_id'],$casesArray))
                abort(403,'Debes escoger los casos que el abogado mismo esta llevando');
        $folder = Folder::create($data);
        return FolderResource::make($folder);
    }
    public function show(Folder $folder) {
        Gate::authorize('view',$folder);
        return FolderResource::make($folder);
    }
    public function update(UpdateFolderRequest $request, Folder $folder) {
        Gate::authorize('update',$folder);
        $data = $request->validated();
        $folder->update($data);
        return FolderResource::make($folder);
    }
    public function destroy(Folder $folder) {
        Gate::authorize('delete',$folder);
        $folder->delete();
        return response()->noContent();
    }
    public function restore(Folder $folder) {
        Gate::authorize('restore',$folder);
        $folder->restore();
        return FolderResource::make($folder);
    }
    public function forceDelete(Folder $folder) {
        Gate::authorize('forceDelete',$folder);
        $folder->forceDelete();
        return response()->noContent();
    }
    private function query():Builder{
        $query = Folder::query();
        $userAuth = Auth::guard('api')->user();
        if($userAuth->role === 'lawyer')
            $query->whereRelation('numberCase','lawyer_id',$userAuth->id);
        if($userAuth->role === 'secretary')
            $query->whereRelation('numberCase','lawyer_id',$userAuth->lawyer_id);
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