<?php

namespace App\Http\Controllers;

use App\Services\CvService;
use Illuminate\Support\Facades\Cache;

class CvController extends Controller
{
    /**
     * Get CV data.
     */
    public function get(CvService $cvService)
    {
        $cvData = Cache::get('cv');

        //if ($cvData) {
            $cvData = $cvService->get();
            Cache::forever('cv', $cvData);
        //}

        return response()->json(['data' => $cvData]);
    }
}
