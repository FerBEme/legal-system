<?php
namespace App\Http\Requests\Customer;
use Illuminate\Foundation\Http\FormRequest;
class UpdateCustomerRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        $customer = $this->route('customer');
        return [
            'document_type' => 'required|in:dni,ce,ruc',
            'document_number' => 'required|max_digits:11|unique:customers,document_number,' . $customer->id,
            'business_name' => 'nullable|string|max:255',
            'first_names' => 'nullable|string|max:255',
            'paternal_surname' => 'nullable|string|max:255',
            'maternal_surname' => 'nullable|string|max:255',
            'phone' => 'nullable',
            'email' => 'nullable',
            'home_address' => 'nullable|string|max:255',
            'district_address' => 'nullable|string|max:255',
            'province_address' => 'nullable|string|max:255',
            'department_address' => 'nullable|string|max:255',
        ];
    }
}