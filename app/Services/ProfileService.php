<?php

namespace App\Services;

use App\Enums\ProfileEnum;
use Carbon\Carbon;

class ProfileService
{
    public function getYearsWorked(): int
    {
        $workStartDate = Carbon::parse(ProfileEnum::WORK_START_DATE->value);

        $yearsWorked = $workStartDate->diffInYears(Carbon::now());
        return floor($yearsWorked);
    }
}
