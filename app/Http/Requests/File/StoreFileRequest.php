<?php
namespace App\Http\Requests\File;
use Illuminate\Foundation\Http\FormRequest;
class StoreFileRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'path' => 'required|file',
            'folder_id' => 'required|integer|exists:folders,id',
        ];
    }
    public function messages(): array {
        return [
            'path.required' => 'El campo de Path es obligatorio',
            'path.file' => 'El campo de Path debe ser archivo',
            'folder_id.required' => 'El campo de Folder Asignado es obligatorio',
            'folder_id.integer' => 'El campo de Folder Asignado debe ser entero',
            'folder_id.exists' => 'El campo de Folder Asignado debe existir en el sistema',
        ];
    }
}