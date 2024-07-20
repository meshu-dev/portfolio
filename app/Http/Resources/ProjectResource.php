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

        return [
            'name'         => $this->name,
            'description'  => $this->description,
            'url'          => $this->url,
            'repositories' => RepositoryResource::collection($this->repositories),
            'technologies' => $technologies
        ];
    }
}
