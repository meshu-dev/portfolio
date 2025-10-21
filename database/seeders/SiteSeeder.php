<?php

namespace Database\Seeders;

use App\Actions\File\UploadFileAction;
use App\Enums\TypeEnum;
use App\Models\{File, Site};
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $githubIcon    = Site::create(['name' => 'GitHub', 'url'  => 'https://github.com/meshu-dev']);
        $linkedInIcon  = Site::create(['name' => 'LinkedIn', 'url'  => 'https://www.linkedin.com/in/harmeshuppal']);
        $portfolioIcon = Site::create(['name' => 'Portfolio', 'url'  => 'https://meshpro.io/portfolio']);

        $this->addIconFile(TypeEnum::CV, $githubIcon, 'github-cv.png');
        $this->addIconFile(TypeEnum::CV, $linkedInIcon, 'linkedin-cv.png');
        $this->addIconFile(TypeEnum::CV, $portfolioIcon, 'portfolio-icon.png');
    }

    protected function addIconFile(TypeEnum $type, Site $site, string $filename): void
    {
        $fileUrl = resolve(UploadFileAction::class)->execute($filename);

        if ($fileUrl) {
            $file = File::create([
                'name' => $filename,
                'url'  => $fileUrl
            ]);

            $site->files()->attach($file->id, ['type_id' => $type->value]);
        }
    }
}
