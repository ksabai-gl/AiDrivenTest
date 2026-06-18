<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Artisan;
/**
 * This job only run at extension
 * Not implement at module, because module can use module job
 */
class RunCommandJob implements ShouldQueue,ShouldQueueAfterCommit
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $command)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Artisan::call($this->command);
    }
}
