<?php

namespace App\Http\Controllers\Api;

use App\Actions\Cv\GetCvAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    /**
     * Get CV data.
     */
    public function get(GetCvAction $getCvAction): JsonResponse
    {
        $data = $getCvAction->execute(Auth::id());
        return response()->json(['data' => $data]);
    }
}
