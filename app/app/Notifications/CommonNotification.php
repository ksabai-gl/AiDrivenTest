<?php

namespace App\Notifications;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommonNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private array $data, private HookDispatcher $hook) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $this->data = $this->hook->dispatch(new HookContext(
            HookAction::CREATE,
            HookPhase::RESPONSE,
            HookTiming::ON,
            'CommonNotification',$this->data));
        $mail = (new MailMessage)
            ->subject($this->data['subject'] ?? 'No subject');
        if(!empty($this->data['mailer'])) {
            $mail =$mail->mailer($this->data['mailer']);
        }
        foreach($this->data['messages'] ?? [] as $line) {
            $mail = $mail->line($line); 
        }
        if(!empty($this->data['link'])) { 
            $mail = $mail->action('Notification Action', $this->data['link']);
        }
        $mail = $mail->line('Thank you for using our application!');
        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
