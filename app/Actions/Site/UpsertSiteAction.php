<?php

namespace App\Actions\Site;

use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class UpsertSiteAction
{
    /**
     * @param array $params
     */
    public function execute(array $params): void
    {
        $userId = Auth::id();

        if (isset($params['id'])) {
            $id = $params['id'];
            unset($params['id']);

            Site::where('user_id', $userId)
                ->where('id', $id)
                ->update([
                    'name' => $params['name'],
                    'url'  => $params['url'],
                ]);
        } else {
            $params['user_id'] = $userId;
            Site::create($params);
        }
    }
}
