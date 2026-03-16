<?php

namespace App\Actions\Portfolio\Project;

use App\Actions\File\DeleteFileAction;
use App\Actions\File\UploadFileAction;
use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class UpsertProjectAction
{
    /**
     * @param array<string, mixed> $params
     */
    public function execute(array $params): void
    {
        $userId = Auth::id();

        if (!empty($params['id'])) {
            $id = $params['id'];
            unset($params['id']);

            $project = Project::where('user_id', $userId)
                              ->where('id', $id)
                              ->firstOrFail();

            $project->update([
                'name'        => $params['name'],
                'description' => $params['description'],
                'url'         => $params['url'],
            ]);

        } else {
            $params['user_id'] = $userId;
            $project = Project::create($params);
        }
        $project->repositories()->sync($params['repositories']);
        $project->technologies()->sync($params['technologies']);

        $this->upsertImage($project, $params);
    }

    /**
     * @param Project $project
     * @param array<string, mixed> $params
     */
    private function upsertImage(Project $project, array $params): void
    {
        $removeImage = $params['remove_image'] ?? false;

        if ($project->image && $removeImage) {
            $this->removeImage($project);
        }

        $uploadedImage = isset($params['image']) ? $params['image'] : null;

        if ($uploadedImage) {
            $this->addImage($project, $uploadedImage);
        }
    }

    /**
     * @param Project $project
     */
    private function removeImage(Project $project): void
    {
        $file = $project->image;

        if ($file) {
            $project->files()->detach($file->id);
            resolve(DeleteFileAction::class)->execute($file);
        }
    }

    /**
     * @param Project $project
     * @param UploadedFile $newFile
     */
    private function addImage(Project $project, UploadedFile $newFile): void
    {
        $file = resolve(UploadFileAction::class)->execute($newFile);
        $project->files()->attach($file->id);
    }
}
