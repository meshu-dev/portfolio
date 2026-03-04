<?php

namespace App\Actions\Portfolio\Intro;

use App\Repositories\TextRepository;

class UpdateIntroAction
{
    public function __construct(
        protected TextRepository $textRepository
    ) {
    }

    /**
     * @param int $userId
     * @param string $line1
     * @param string $line2
     */
    public function execute(int $userId, string $line1, string $line2): void
    {
        $introTexts = $this->textRepository
                           ->getByNames($userId, ['portfolio_intro_1', 'portfolio_intro_2'])
                           ->toArray();

        //$introTexts = $introTexts->keyBy('name');

        //$line1Model = $introText->get('portfolio_intro_1');
        
        
    }
}
