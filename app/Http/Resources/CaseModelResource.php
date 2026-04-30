<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CaseModelResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'file_number' => $this->whenHas('file_number'),
            'jurisdictional_body' => $this->whenHas('jurisdictional_body'),
            'judge' => $this->whenHas('judge'),
            'start_date' => $this->whenHas('start_date'),
            'subject' => $this->whenHas('subject'),
            'procedural_stage' => $this->whenHas('procedural_stage'),
            'location' => $this->whenHas('location'),
            'sumilla' => $this->whenHas('sumilla'),
            'judicial_district' => $this->whenHas('judicial_district'),
            'legal_specialist' => $this->whenHas('legal_specialist'),
            'process' => $this->whenHas('process'),
            'specialty' => $this->whenHas('specialty'),
            'status' => $this->whenHas('status'),
            'completion_date' => $this->whenHas('completion_date'),
            'reason_conclusion' => $this->whenHas('reason_conclusion'),
            'lawyer_id' => $this->whenHas('lawyer_id'),
            'customer_id' => $this->whenHas('customer_id'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'lawyer' => UserResource::make($this->whenLoaded('lawyer')),
            'customer' => CustomerResource::make($this->whenLoaded('customer')),
        ];
    }
}