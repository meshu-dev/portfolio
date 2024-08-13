<?php

namespace App\Http\Controllers;

use App\Actions\Cv\GetCvAction;

class CvController extends Controller
{
    /**
     * Get CV data.
     */
    public function get(GetCvAction $getCvAction)
    {
        $data = $getCvAction->execute();
        return response()->json(['data' => $data]);
    }
}
