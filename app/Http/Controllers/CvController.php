<?php

namespace App\Http\Controllers;

use App\Actions\Cv\GetCvAction;
use Illuminate\Http\JsonResponse;

class CvController extends Controller
{
    /**
     * Get CV data.
     */
    public function get(GetCvAction $getCvAction): JsonResponse
    {
        $data = $getCvAction->execute();
        return response()->json(['data' => $data]);
    }
}
