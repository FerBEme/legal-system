<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class SpecialtyResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'description' => $this->whenHas('description'),
            'parent_id' => $this->whenHas('parent_id'),
            'level' => $this->whenHas('level'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'mainBranch' => SpecialtyResource::make($this->whenLoaded('mainBranch')),
            'lawyers' => SpecialtyResource::collection($this->whenLoaded('lawyers')),
        ];
    }
}