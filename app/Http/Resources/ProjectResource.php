<?php

namespace App\Http\Resources;

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
        $technologies = TechnologyResource::collection($this->technologies);
        $technologies = $technologies->pluck('name');

        $imageUrl = isset($this->files[0]) ? $this->files[0]->url : null;

        return [
            'name'         => $this->name,
            'description'  => $this->description,
            'url'          => $this->url,
            'image'        => $imageUrl,
            'repositories' => RepositoryResource::collection($this->repositories),
            'technologies' => $technologies
        ];
    }
}
