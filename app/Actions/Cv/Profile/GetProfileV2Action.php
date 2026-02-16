<?php

namespace App\Actions\Cv\Profile;

use App\Actions\Portfolio\GetDynamicTextAction;
use App\Repositories\TextRepository;
use Illuminate\Support\Facades\Auth;

class GetProfileV2Action
{
    public function __construct(
        protected TextRepository $textRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute()
    {
        $details = $this->textRepository->getByNames(Auth::id(), ['fullname', 'intro', 'location']);
        $details['intro'] = resolve(GetDynamicTextAction::class)->execute($details['intro']);

        return $details;
    }
}
