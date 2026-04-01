<?php

namespace Database\Seeders;

use App\Models\{File, Site, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class SiteSeeder extends Seeder
{
    public function run(Collection $users): void
    {
        $data = require('data/user_data.php');
        $sites = $data['sites'];

        foreach ($users as $user) {
            foreach ($sites as $site) {
                $this->addSite($user, $site);
            }
        }
    }

    protected function addSite(User $user, array $site): void
    {
        $params = [
            'user_id' => $user->id,
            'name'    => $site['name'],
            'url'     => $site['url'],
        ];

        $siteModel = Site::create($params);
        $siteModel->types()->attach($site['types']);

        $params = [
            'user_id' => $user->id,
            'name'    => $site['file']['name'],
            'url'     => $site['file']['url'],
        ];

        $this->addFile($siteModel, $params);
    }

    protected function addFile(Site $site, array $params): void
    {
        $file = File::create($params);

        $site->file_id = $file->id;
        $site->save();
    }
}
