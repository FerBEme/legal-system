<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class UserResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'document_type' => $this->whenHas('document_type'),
            'document_number' => $this->whenHas('document_number'),
            'first_names' => $this->whenHas('first_names'),
            'paternal_surname' => $this->whenHas('paternal_surname'),
            'maternal_surname' => $this->whenHas('maternal_surname'),
            'phone' => $this->whenHas('phone'),
            'email' => $this->whenHas('email'),
            'password' => $this->whenHas('password'),
            'profile_photo' => $this->profile_photo ? Storage::url($this->profile_photo) : 'https://cdn-icons-png.flaticon.com/512/12225/12225881.png',
            'role' => $this->whenHas('role'),
            'tuition_number' => $this->whenHas('tuition_number'),
            'lawyer_id' => $this->whenHas('lawyer_id'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'lawyer' => UserResource::make($this->whenLoaded('lawyer')),
        ];
    }
}