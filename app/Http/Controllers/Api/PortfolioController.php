<?php

namespace App\Http\Controllers\Api;

use App\Actions\Portfolio\GetPortfolioAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\{AboutResource, IntroResource, ProjectResource};
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function get(GetPortfolioAction $getPortfolioAction): JsonResponse
    {
        $data = $getPortfolioAction->execute((int) Auth::id());

        return response()->json([
            'data' => [
                'intro'    => resolve(IntroResource::class, ['resource' => $data['intro']]),
                'about'    => resolve(AboutResource::class, ['resource' => $data['about']]),
                'projects' => ProjectResource::collection($data['projects']),
            ],
        ]);
    }
}
