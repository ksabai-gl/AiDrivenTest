<?php

namespace App\Jobs;

use Core\Notifications\Application\DTOs\InsertManyNotificationRequest;
use Core\Notifications\Application\UseCases\InsertManyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class CreateNotificationJob implements ShouldQueue,ShouldQueueAfterCommit
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $notiAdapter)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $insertManyNotification = app(InsertManyNotification::class);
        $insertManyNotification->handle( 
            InsertManyNotificationRequest::fromArray($this->notiAdapter)
        );
    }
}
