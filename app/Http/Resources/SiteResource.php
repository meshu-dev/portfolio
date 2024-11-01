<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Collection $files */
        $files = FileResource::collection($this->files);
        $file  = $files->first();

        return [
            'name'   => $this->name,
            'url'    => $this->url,
            'image'  => $file['url'] ?? null
        ];
    }
}
