<?php
namespace App\Http\Requests\CaseModel;
use Illuminate\Foundation\Http\FormRequest;
class StoreCaseModelRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'file_number' => 'required|unique:cases,file_number',
            'jurisdictional_body' => 'nullable|string',
            'judge' => 'nullable|string',
            'start_date' => 'nullable',
            'subject' => 'nullable|string',
            'procedural_stage' => 'nullable|string',
            'location' => 'nullable|string',
            'sumilla' => 'nullable|string',
            'judicial_district' => 'nullable|string',
            'legal_specialist' => 'nullable|string',
            'process' => 'nullable|string',
            'specialty' => 'nullable|string',
            'status' => 'nullable|string',
            'completion_date' => 'nullable',
            'reason_conclusion' => 'nullable|string',
            'lawyer_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
        ];
    }
}