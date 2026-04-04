<?php

namespace App\Http\Controllers\Api;

use App\Actions\Cv\GetCvAction;
use App\Actions\Cv\Pdf\GetPdfFileAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\{
    ProfileResource,
    SkillResource,
    WorkExperienceResource
};
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function get(GetCvAction $getCvAction): JsonResponse
    {
        $data = $getCvAction->execute((int) Auth::id());

        return response()->json([
            'data' => [
                'profile'          => resolve(ProfileResource::class, ['resource' => $data['profile']]),
                'skills'           => SkillResource::collection($data['skills']),
                'work_experiences' => WorkExperienceResource::collection($data['workExperiences']),
                'pdf'              => $data['pdfUrl'],
            ]
        ]);
    }
}
