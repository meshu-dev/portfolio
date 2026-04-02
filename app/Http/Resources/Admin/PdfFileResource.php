<?php

namespace App\Http\Resources\Admin;

use App\Actions\File\GetFileUrlAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PdfFileResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'url'        => $this->url,
            'image_url'  => resolve(GetFileUrlAction::class)->execute($this->resource),
            'updated_at' => $this->updated_at,
        ];
    }
}
