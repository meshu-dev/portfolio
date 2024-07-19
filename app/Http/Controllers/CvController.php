<?php

namespace App\Http\Controllers;

use App\Http\Resources\CvResource;
use App\Actions\Cv\GetCvAction;
use Illuminate\Support\Facades\Cache;

class CvController extends Controller
{
    /**
     * Get CV data.
     */
    public function get(GetCvAction $getCvAction)
    {
        $data = Cache::get('cv');

        if (!$data) {
            $data = $getCvAction->execute();
            Cache::forever('cv', $data);
        }

        return response()->json(['data' => $data]);
    }
}
