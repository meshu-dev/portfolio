<?php

namespace App\Http\Resources;

use App\Actions\Site\GetSitesByTypeAction;
use App\Enums\TypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sites = resolve(GetSitesByTypeAction::class)->execute((int) Auth::id(), TypeEnum::CV);

        return [
            'fullname' => $this->fullname,
            'intro'    => $this->formattedIntro,
            'location' => $this->location,
            'sites'    => SiteResource::collection($sites)
        ];
    }
}
