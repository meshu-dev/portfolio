<?php

namespace Database\Seeders;

use App\Actions\File\MoveFileAction;
use App\Enums\{TypeEnum, UserEnum};
use App\Exceptions\FileNotUploadedException;
use App\Models\{File, Site};
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $githubSite    = Site::create(['user_id' => UserEnum::ADMIN, 'name' => 'GitHub', 'url'  => 'https://github.com/meshu-dev']);
        $linkedInSite  = Site::create(['user_id' => UserEnum::ADMIN, 'name' => 'LinkedIn', 'url'  => 'https://www.linkedin.com/in/harmeshuppal']);
        $portfolioSite = Site::create(['user_id' => UserEnum::ADMIN, 'name' => 'Portfolio', 'url'  => 'https://meshpro.io/portfolio']);

        $this->addIconFile($githubSite, 'github-cv.png');
        $this->addIconFile($linkedInSite, 'linkedin-cv.png');
        $this->addIconFile($portfolioSite, 'portfolio-icon.png');

        $githubSite->types()->attach([TypeEnum::CV->value, TypeEnum::PORTFOLIO->value]);
        $linkedInSite->types()->attach([TypeEnum::CV->value, TypeEnum::PORTFOLIO->value]);
        $portfolioSite->types()->attach([TypeEnum::CV->value]);
    }

    protected function addIconFile(Site $site, string $filename): void
    {
        try {
            $fileUrl = resolve(MoveFileAction::class)->execute($filename);
        } catch (FileNotUploadedException) {
            $fileUrl = fake()->placeholderImageUrl(64, 64);
        }

        $file = File::create([
            'user_id' => UserEnum::ADMIN,
            'name'    => $filename,
            'url'     => $fileUrl,
        ]);

        $site->file_id = $file->id;
        $site->save();
    }
}
