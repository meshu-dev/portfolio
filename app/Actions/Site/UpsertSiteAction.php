<?php

namespace App\Actions\Site;

use App\Actions\File\DeleteFileAction;
use App\Actions\File\UploadFileAction;
use App\Models\Site;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class UpsertSiteAction
{
    /**
     * @param array<string, mixed> $params
     */
    public function execute(array $params): void
    {
        $userId = Auth::id();

        if (isset($params['id'])) {
            $id = $params['id'];
            unset($params['id']);

            $site = Site::where('user_id', $userId)
                        ->where('id', $id)
                        ->firstOrFail();

            $site->update([
                'name' => $params['name'],
                'url'  => $params['url'],
            ]);

            $this->upsertImage($site, $params);
        } else {
            $params['user_id'] = $userId;
            $site = Site::create($params);

            if (isset($params['image'])) {
                $this->addImage($site, $params['image']);
            }
        }
        $site->types()->sync($params['types']);
    }

    /**
     * @param Site $site
     * @param array<string, mixed> $params
     */
    private function upsertImage(Site $site, array $params): void
    {
        $removeImage = $params['remove_image'] ?? false;

        if ($site->image && $removeImage) {
            $this->removeImage($site);
        }

        $uploadedImage = isset($params['image']) ? $params['image'] : null;

        if ($uploadedImage) {
            $this->addImage($site, $uploadedImage);
        }
    }

    /**
     * @param Site $site
     */
    private function removeImage(Site $site): void
    {
        $file = $site->image;

        if ($file) {
            $site->file_id = null;
            $site->save();

            resolve(DeleteFileAction::class)->execute($file);
        }
    }

    /**
     * @param Site $site
     * @param UploadedFile $newFile
     */
    private function addImage(Site $site, UploadedFile $newFile): void
    {
        $file = resolve(UploadFileAction::class)->execute($newFile);

        if ($file->id > 0) {
            $site->file_id = $file->id;
            $site->save();
        }
    }
}
