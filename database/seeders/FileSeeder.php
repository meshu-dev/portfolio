<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FileSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $files = Storage::disk('s3')->allFiles();

        foreach ($files as $file) {
            File::create([
                'name' => $file,
                'url'  => $file
            ]);
        }
    }
}
