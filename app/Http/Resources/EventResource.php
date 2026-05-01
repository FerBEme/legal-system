<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class EventResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'title' => $this->whenHas('title'),
            'event_type' => $this->whenHas('event_type'),
            'start_date' => $this->whenHas('start_date'),
            'end_date' => $this->whenHas('end_date'),
            'meeting_link' => $this->whenHas('meeting_link'),
            'description' => $this->whenHas('description'),
            'case_id' => $this->whenHas('case_id'),
            'created_by' => $this->whenHas('created_by'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'numberCase' => CaseModelResource::make($this->whenLoaded('numberCase')),
            'creater' => UserResource::make($this->whenLoaded('creater')),
        ];
    }
}