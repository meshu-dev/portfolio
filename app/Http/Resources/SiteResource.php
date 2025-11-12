<?php

namespace App\Http\Resources;

use App\Actions\File\GetFileUrlAction;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

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
        /** @var Collection<int, File> $files */
        $files   = FileResource::collection($this->files);
        $file    = $files->first();

        $fileUrl = $file?->name ? resolve(GetFileUrlAction::class, ['name' => $file->name])->execute() : null;

        return [
            'name'   => $this->name,
            'url'    => $this->url,
            'image'  => $fileUrl,
        ];
    }
}
