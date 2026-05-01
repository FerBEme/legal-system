<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class FileResource extends JsonResource {
    public function toArray(Request $request): array {
        return [
            'id' => $this->whenHas('id'),
            'name' => $this->whenHas('name'),
            'path' => $this->path ? Storage::url($this->path) : null,
            'mime_type' => $this->whenHas('mime_type'),
            'extension' => $this->whenHas('extension'),
            'size' => $this->whenHas('size'),
            'uploaded_by' => $this->whenHas('uploaded_by'),
            'folder_id' => $this->whenHas('folder_id'),
            'created_at' => $this->whenHas('created_at'),
            'updated_at' => $this->whenHas('updated_at'),
            'uploader' => UserResource::make($this->whenLoaded('uploader')),
            'folder' => FolderResource::make($this->whenLoaded('folder')),
        ];
    }
}