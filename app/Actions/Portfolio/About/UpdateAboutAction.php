<?php

namespace App\Actions\Portfolio\About;

use App\Actions\Cv\Skill\UpdateSkillTechnologiesAction;
use App\Actions\File\DeleteFileAction;
use App\Actions\File\UploadFileAction;
use App\Models\About;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class UpdateAboutAction
{
    /**
     * @param array<string, mixed> $params
     */
    public function execute(array $params): void
    {
        $userId = (int) Auth::id();

        $about = About::where('user_id', $userId)->firstOrFail();
        $about->update(['text' => $params['text']]);

        if ($about->skill?->id) {
            $skillTechnologies = [[
                'id' => $about->skill->id,
                'technologies' => $params['technologies']
            ]];

            resolve(UpdateSkillTechnologiesAction::class)->execute($skillTechnologies);
        }

        $this->upsertImage($about, $params);
    }

    /**
     * @param About $about
     * @param array<string, mixed> $params
     */
    private function upsertImage(About $about, array $params): void
    {
        $removeImage = $params['remove_image'] ?? false;

        if ($about->image && $removeImage) {
            $this->removeImage($about);
        }

        $uploadedImage = isset($params['image']) ? $params['image'] : null;

        if ($uploadedImage) {
            $this->addImage($about, $uploadedImage);
        }
    }

    /**
     * @param About $about
     */
    private function removeImage(About $about): void
    {
        $file = $about->image;

        if ($file) {
            $about->file_id = null;
            $about->save();

            resolve(DeleteFileAction::class)->execute($file);
        }
    }

    /**
     * @param About $about
     * @param UploadedFile $newFile
     */
    private function addImage(About $about, UploadedFile $newFile): void
    {
        $file = resolve(UploadFileAction::class)->execute($newFile);

        if ($file->id > 0) {
            $about->file_id = $file->id;
            $about->save();
        }
    }
}
