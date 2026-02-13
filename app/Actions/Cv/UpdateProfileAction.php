<?php

namespace App\Actions\Cv;

use App\Enums\ProfileNameEnum;
use App\Repositories\TextRepository;

class UpdateProfileAction
{
    public function __construct(
        protected TextRepository $textRepository
    ) {
    }

    /**
     * @param string $intro
     * @param string $location
     */
    public function execute(string $intro, string $location): void
    {
        $this->textRepository->updateByName(ProfileNameEnum::INTRO->value, $intro);
        $this->textRepository->updateByName(ProfileNameEnum::LOCATION->value, $location);
    }
}
