<?php
namespace App\Http\Requests\Event;
use Illuminate\Foundation\Http\FormRequest;
class StoreEventRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }
    public function rules(): array {
        return [
            'title' => 'required|string|max:255',
            'event_type' => 'required|in:audience,client_meeting,task',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'meeting_link' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'case_id' => 'nullable|exists:cases,id',
        ];
    }
}