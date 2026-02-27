<?php

namespace App\Actions\Cv\Profile;

use App\Actions\Portfolio\GetDynamicTextAction;
use App\Models\Text;
use App\Repositories\TextRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GetProfileAction
{
    public function __construct(
        protected TextRepository $textRepository
    ) {
    }

    /**
     * @return Collection<int, Text>
     */
    public function execute(int $userId): Collection
    {
        $details = $this->textRepository->getByNames($userId, ['fullname', 'intro', 'location']);
        $details['intro'] = resolve(GetDynamicTextAction::class)->execute($details['intro']);

        return $details;
    }
}
