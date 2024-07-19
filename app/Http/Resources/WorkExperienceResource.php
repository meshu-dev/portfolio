<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'            => $this->title,
            'company'          => $this->company,
            'location'         => $this->location,
            'date'             => $this->date,
            'description'      => $this->description,
            'responsibilities' => $this->responsibilities
        ];
    }
}
