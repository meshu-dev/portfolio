<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'url'          => $this->url,
            'image_url'    => $this->image ? Storage::temporaryUrl($this->image->url, now()->addMinutes(60)) : null,
            'repositories' => $this->repositories,
            'technologies' => $this->technologies
        ];
    }
}
