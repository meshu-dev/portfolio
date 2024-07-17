<?php

namespace Database\Seeders;

use App\Enums\TypeEnum;
use App\Models\{File, Icon};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class IconSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $githubIcon = Icon::create(['name' => 'GitHub', 'url'  => 'https://github.com/meshu-dev']);
        $linkedInIcon = Icon::create(['name' => 'LinkedIn', 'url'  => 'https://www.linkedin.com/in/harmeshuppal']);
        $portfolioIcon = Icon::create(['name' => 'Portfolio', 'url'  => 'https://meshpro.io/projects']);

        $this->addIconFile(TypeEnum::CV, $githubIcon, 'github-cv.png');
        $this->addIconFile(TypeEnum::CV, $linkedInIcon, 'linkedin-cv.png');
        $this->addIconFile(TypeEnum::CV, $portfolioIcon, 'portfolio-icon.png');
        $this->addIconFile(TypeEnum::PORTFOLIO, $githubIcon, 'github-portfolio.png');
        $this->addIconFile(TypeEnum::PORTFOLIO, $linkedInIcon, 'linkedin-portfolio.png');
    }

    protected function addIconFile(TypeEnum $type, Icon $icon, string $filename): void
    {
        $projectFileUrl = Storage::disk('s3')->url($filename);

        if ($projectFileUrl) {
            $file = File::create([
                'name' => $filename,
                'url'  => $projectFileUrl
            ]);

            $icon->files()->attach($file->id, ['type_id' => $type->value]);
        }
    }
}
