<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\CommonNotification;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Foundation\Queue\Queueable;

class SendMailJob implements ShouldQueue, ShouldQueueAfterCommit
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $user_id,
        private string $subject,
        private string $message,
        private string $link
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(HookDispatcher $hook): void
    {
        //
        $user = User::where('id', $this->user_id)->first();
        if (!$user) {
            return;
        }
        $mail = $hook->dispatch(new HookContext(
            HookAction::CREATE,
            HookPhase::RESPONSE,
            HookTiming::BEFORE,
            'UserNotify',
            [
                'subject' => $this->subject,
                'messages' => [$this->message],
                'link' => $this->link,
                'user' => $user->toArray()
            ]
        ));
        $user->notify(new CommonNotification($mail,$hook));
        $hook->dispatch(new HookContext(
            HookAction::CREATE,
            HookPhase::RESPONSE,
            HookTiming::AFTER,
            'UserNotify',$mail
        ));
    }
}
