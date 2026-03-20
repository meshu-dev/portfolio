<?php

namespace App\Http\Resources;

use App\Actions\Site\GetSitesByTypeAction;
use App\Enums\TypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sites = resolve(GetSitesByTypeAction::class)->execute(TypeEnum::PORTFOLIO);

        return [
            'intro'    => $this->line1,
            'location' => $this->formattedLine2,
            'sites'    => SiteResource::collection($sites)
        ];
    }
}
