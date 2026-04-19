<?php

namespace App\Http\Resources;

use App\Actions\File\GetFileUrlAction;
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
        return [
            'name'      => $this->name,
            'url'       => $this->url,
            'icon'      => $this->icon,
            'image_url' => $this->image ? resolve(GetFileUrlAction::class)->execute($this->image) : null,
        ];
    }
}
