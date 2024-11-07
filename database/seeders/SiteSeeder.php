<?php

namespace Database\Seeders;

use App\Enums\TypeEnum;
use App\Models\{File, Site};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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

        $this->addIconFile(TypeEnum::CV, $githubIcon, 'site/github-cv.png');
        $this->addIconFile(TypeEnum::CV, $linkedInIcon, 'site/linkedin-cv.png');
        $this->addIconFile(TypeEnum::CV, $portfolioIcon, 'site/portfolio-icon.png');
        $this->addIconFile(TypeEnum::PORTFOLIO, $githubIcon, 'site/github-portfolio.svg');
        $this->addIconFile(TypeEnum::PORTFOLIO, $linkedInIcon, 'site/linkedin-portfolio.svg');
    }

    protected function addIconFile(TypeEnum $type, Site $site, string $filename): void
    {
        $imageUrl = config('app.add_seeder_files') ? Storage::disk('s3')->url($filename) : fake()->imageUrl();

        $file = File::create([
            'name' => basename($filename),
            'url'  => $imageUrl
        ]);

        $site->files()->attach($file->id, ['type_id' => $type->value]);
    }
}
