<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Requests\File\UpdateFileRequest;
use App\Http\Resources\FileResource;
use App\Models\CaseModel;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller {
    public function index() {
        Gate::authorize('viewAny',File::class);
        $query = $this->query();
        $files = request('perPage')
            ? $query->paginate(request('perPage'))
            : $query->get();
        return FileResource::collection($files);
    }
    public function store(StoreFileRequest $request) {
        Gate::authorize('create',File::class);
        $userAuth = Auth::guard('api')->user();
        if (in_array($userAuth->role, ['lawyer', 'secretary'])) {
            $lawyerId = $userAuth->role === 'lawyer'
                ? $userAuth->id
                : $userAuth->lawyer_id;
            $caseIds = CaseModel::whereLawyerId($lawyerId)->pluck('id');
            $folderArray = Folder::whereIn('case_id',$caseIds)->pluck('id')->toArray();
        }
        $data = $request->validated();
        $uploadedFile = $request->file('path');
        $data['name'] = $uploadedFile->getClientOriginalName();
        $data['path'] = Storage::put('files',$uploadedFile);
        $data['mime_type'] = $uploadedFile->getMimeType();
        $data['extension'] = $uploadedFile->getClientOriginalExtension();
        $data['size'] = $uploadedFile->getSize();
        $data['uploaded_by'] = $userAuth->id;
        if(!in_array($data['folder_id'],$folderArray))
            abort(403,'Favor de Seleccionar la Carpeta que le corresponde');
        $file = File::create($data);
        return FileResource::make($file);
    }
    public function show(File $file) {
        Gate::authorize('view',$file);
        return FileResource::make($file);
    }
    public function update(UpdateFileRequest $request, File $file) {
        Gate::authorize('update',$file);
        $userAuth = Auth::guard('api')->user();
        if (in_array($userAuth->role, ['lawyer', 'secretary'])) {
            $lawyerId = $userAuth->role === 'lawyer'
                ? $userAuth->id
                : $userAuth->lawyer_id;
            $caseIds = CaseModel::whereLawyerId($lawyerId)->pluck('id');
            $folderArray = Folder::whereIn('case_id',$caseIds)->pluck('id')->toArray();
        }
        $data = $request->validated();
        $uploadedFile = $request->file('path');
        $data['name'] = $uploadedFile->getClientOriginalName();
        $data['path'] = Storage::put('files',$uploadedFile);
        $data['mime_type'] = $uploadedFile->getMimeType();
        $data['extension'] = $uploadedFile->getClientOriginalExtension();
        $data['size'] = $uploadedFile->getSize();
        $data['uploaded_by'] = $userAuth->id;
        if(!in_array($data['folder_id'],$folderArray))
            abort(403,'Favor de Seleccionar la Carpeta que le corresponde');
        $file->update($data);
        return FileResource::make($file);
    }
    public function destroy(File $file) {
        Gate::authorize('delete',$file);
        $file->delete();
        return response()->noContent();
    }
    public function restore(File $file) {
        Gate::authorize('restore',$file);
        $file->restore();
        return FileResource::make($file);
    }
    public function forceDelete(File $file) {
        Gate::authorize('forceDelete',$file);
        $file->forceDelete();
        return response()->noContent();
    }
    private function query():Builder{
        $query = File::query();
        $userAuth = Auth::guard('api')->user();
        if (in_array($userAuth->role, ['lawyer', 'secretary'])) {
            $lawyerId = $userAuth->role === 'lawyer'
                ? $userAuth->id
                : $userAuth->lawyer_id;
            $caseIds = CaseModel::whereLawyerId($lawyerId)->pluck('id');
            $folderIds = Folder::whereIn('case_id',$caseIds)->pluck('id');
            $query->whereIn('folder_id',$folderIds);
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