<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    /**
     * Get CV data.
     */
    public function get(ProjectRepository $projectRepository)
    {
        $projectData = Cache::get('projects');

        //if ($cvData) {
            $projectData = $projectRepository->getAll();
            Cache::forever('projects', $projectData);
        //}

        return response()->json(['data' => $projectData]);
    }
}
