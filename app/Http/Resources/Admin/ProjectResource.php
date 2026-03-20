<?php

namespace App\Http\Resources\Admin;

use App\Actions\File\GetFileUrlAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'image_url'    => $this->image ? resolve(GetFileUrlAction::class)->execute($this->image) : null,
            'repositories' => $this->repositories,
            'technologies' => $this->technologies
        ];
    }
}
