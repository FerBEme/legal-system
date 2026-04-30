<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CustomerResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'document_type' => $this->whenHas('document_type'),
            'document_number' => $this->whenHas('document_number'),
            'business_name' => $this->whenHas('business_name'),
            'first_names' => $this->whenHas('first_names'),
            'paternal_surname' => $this->whenHas('paternal_surname'),
            'maternal_surname' => $this->whenHas('maternal_surname'),
            'phone' => $this->whenHas('phone'),
            'email' => $this->whenHas('email'),
            'home_address' => $this->whenHas('home_address'),
            'district_address' => $this->whenHas('district_address'),
            'province_address' => $this->whenHas('province_address'),
            'department_address' => $this->whenHas('department_address'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
        ];
    }
}