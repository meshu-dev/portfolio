<?php

namespace App\Jobs;

use App\Actions\Cv\Pdf\CreatePdfAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCvPdfJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param int $userId
     */
    public function __construct(
        public int $userId
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(CreatePdfAction $createPdfAction): void
    {
        $createPdfAction->execute($this->userId);
    }
}
