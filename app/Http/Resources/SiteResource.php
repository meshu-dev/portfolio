<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $file = FileResource::collection($this->files)->first();

        return [
            'name'   => $this->name,
            'url'    => $this->url,
            'image'  => $file['url'] ?? null
        ];
    }
}
