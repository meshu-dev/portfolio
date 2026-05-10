<?php

namespace App\Actions\Site;

use App\Models\Site;
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
                'name'  => $params['name'],
                'url'   => $params['url'],
                'icons' => $params['icons'],
            ]);
        } else {
            $params['user_id'] = $userId;
            $site = Site::create($params);
        }
        $site->types()->sync($params['types']);
    }
}
