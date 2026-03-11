<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image_url'    => $this->image ? Storage::temporaryUrl($this->image->url, now()->addMinutes(60)) : null,
            'text'         => $this->text,
            'technologies' => $this->skill->technologies
        ];
    }
}
