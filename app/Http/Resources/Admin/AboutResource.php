<?php

namespace App\Http\Resources\Admin;

use App\Actions\File\GetFileUrlAction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'image_url'    => $this->image ? resolve(GetFileUrlAction::class)->execute($this->image): null,
            'text'         => $this->text,
            'technologies' => $this->skill->technologies
        ];
    }
}
