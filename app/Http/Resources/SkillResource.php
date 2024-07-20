<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
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
            'name'          => $this->name,
            'technologies'  => $technologies
        ];
    }
}
