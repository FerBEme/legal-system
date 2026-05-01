<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class FolderResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'parent_id' => $this->whenHas('parent_id'),
            'case_id' => $this->whenHas('case_id'),
            'folder' => FolderResource::make($this->whenLoaded('folder')),
            'numberCase' => CaseModelResource::make($this->whenLoaded('numberCase')),
        ];
    }
}