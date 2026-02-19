<?php

namespace App\Http\Resources;

use App\Models\Technology;
use Illuminate\Database\Eloquent\Collection;
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
        /** @var Collection<int, Technology> $technologies */
        $technologies = TechnologyResource::collection($this->technologies);
        $technologies = $technologies->pluck('name');

        return [
            'name'          => $this->name,
            'technologies'  => $technologies
        ];
    }
}
