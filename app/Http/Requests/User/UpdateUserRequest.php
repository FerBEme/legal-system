<?php
namespace App\Http\Requests\User;
use Illuminate\Foundation\Http\FormRequest;
class UpdateUserRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        $user = $this->route('user');
        return [
            'document_type' => 'required|in:dni,ce',
            'document_number' => 'required|numeric|max_digits:9|unique:users,document_number,' . $user->id,
            'first_names' => 'required|string|max:255',
            'paternal_surname' => 'required|string|max:255',
            'maternal_surname' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:9',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|string|min:6',
            'profile_photo' => 'nullable|image',
            'role' => 'required|in:admin,lawyer,secretary',
            'tuition_number' => 'nullable|numeric|max_digits:10',
            'lawyer_id' => 'nullable|integer|exists:users,id',
            'specialties' => 'nullable|array',
            'specialties.*' => 'exists:specialties,id'
        ];
    }
}