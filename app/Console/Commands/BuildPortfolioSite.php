<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class BuildPortfolioSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:build-portfolio-site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calls build web hook to rebuild portfolio frontend website';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $hookUrl = config('app.meshpro_buildhook');
        $response = Http::post($hookUrl);

        if ($response->successful()) {
            $this->info('Build hook called sucessfully!');
        } else {
            $this->error('Call to build hook failed!');
        }
    }
}
