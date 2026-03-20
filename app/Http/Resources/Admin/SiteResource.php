<?php

namespace App\Http\Resources\Admin;

use App\Actions\File\GetFileUrlAction;
use App\Http\Resources\TypeResource;
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
            'id'        => $this->id,
            'name'      => $this->name,
            'url'       => $this->url,
            'image_url' => $this->image ? resolve(GetFileUrlAction::class)->execute($this->image) : null,
            'types'     => TypeResource::collection($this->types)
        ];
    }
}
