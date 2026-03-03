<?php

namespace App\Actions\Cv\Profile;

use App\Actions\Portfolio\GetDynamicTextAction;
use App\Repositories\TextRepository;
use Illuminate\Support\Collection;

class GetProfileAction
{
    public function __construct(
        protected TextRepository $textRepository
    ) {
    }

    /**
     * @return Collection<string, string>
     */
    public function execute(int $userId): Collection
    {
        $details = $this->textRepository->getByNames($userId, ['fullname', 'intro', 'location']);
        $details['intro'] = resolve(GetDynamicTextAction::class)->execute($details['intro']);

        return $details;
    }
}
