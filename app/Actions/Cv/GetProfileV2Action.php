<?php

namespace App\Actions\Cv;

use App\Actions\Portfolio\GetDynamicTextAction;
use App\Repositories\TextRepository;

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
        $details = $this->textRepository->getByNames(['fullname', 'intro', 'location']);
        $details['intro'] = resolve(GetDynamicTextAction::class)->execute($details['intro']);

        return $details;
    }
}
