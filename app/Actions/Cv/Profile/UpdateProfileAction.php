<?php

namespace App\Actions\Cv\Profile;

use App\Enums\ProfileNameEnum;
use App\Repositories\TextRepository;
use Illuminate\Support\Facades\Auth;

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
        $this->textRepository->updateByName(Auth::id(), ProfileNameEnum::INTRO->value, $intro);
        $this->textRepository->updateByName(Auth::id(), ProfileNameEnum::LOCATION->value, $location);
    }
}
