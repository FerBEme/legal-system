<?php
namespace App\Http\Requests\Specialty;
use Illuminate\Foundation\Http\FormRequest;
class StoreSpecialtyRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer|exists:specialties,id',
            'level' => 'nullable|integer|min:2',
            'lawyers' => 'nullable|array',
            'lawyers.*' => 'exists:users,id'
        ];
    }
}