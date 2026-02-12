<?php

namespace App\Actions\Profile;

use App\Enums\ProfileEnum;
use Illuminate\Support\Carbon;

class GetYearsWorkedAction
{
    /**
     * @return int
     */
    public function execute(): int
    {
        $workStartDate = Carbon::parse(ProfileEnum::WORK_START_DATE->value);

        $yearsWorked = $workStartDate->diffInYears(Carbon::now());
        return (int) floor($yearsWorked);
    }
}
