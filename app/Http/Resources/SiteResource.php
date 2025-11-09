<?php

namespace App\Http\Resources;

use App\Actions\File\GetFileUrlAction;
use App\Models\File;
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
        $file    = FileResource::collection($this->files)->first();
        $fileUrl = resolve(GetFileUrlAction::class, ['name' => $file->name])->execute();

        return [
            'name'   => $this->name,
            'url'    => $this->url,
            'image'  => $fileUrl ?? null
        ];
    }
}
