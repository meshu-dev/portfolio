<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UploadFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upload-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uploads files to S3';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = Storage::files('files');

        foreach ($files as $localFile) {
            $filename = basename($localFile);
            $file     = new File(storage_path('app/files') . '/' . $filename);

            $result = Storage::disk('s3')->putFileAs('', $file, $filename, 'public');
        }
    }
}
