<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MakeBroadcastModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-broadcast {module} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $name = Str::studly(trim($this->argument('name')));
        $module = Str::studly(trim($this->argument('module')));
        $basePath = base_path("core/{$module}");
        if (!File::exists($basePath)) {
            $this->error("❌ Module '{$name}' not found!");
            return Command::FAILURE;
        }
        if (!File::isDirectory("{$basePath}/Infrastructure/Broadcasts")) {
            File::makeDirectory("{$basePath}/Infrastructure/Broadcasts", 0777, true);
        }

        File::put("{$basePath}/Infrastructure/Broadcasts/" . $name . "Event.php", <<<PHP
        <?php

            namespace Core\\{$module}\\Infrastructure\Broadcasts;

            use Illuminate\Broadcasting\Channel;
            use Illuminate\Broadcasting\InteractsWithSockets;
            use Illuminate\Broadcasting\PresenceChannel;
            use Illuminate\Broadcasting\PrivateChannel;
            use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
            use Illuminate\Foundation\Events\Dispatchable;
            use Illuminate\Queue\SerializesModels;

            class {$name}Broadcast
            {
                use Dispatchable, InteractsWithSockets, SerializesModels;
                
                /**
                 * Create a new event instance.
                 */
                public function __construct()
                {
                    //
                }

                /**
                 * Get the channels the event should broadcast on.
                 *
                 * @return array<int, \Illuminate\Broadcasting\Channel>
                 */
                public function broadcastOn(): array
                {
                    return [
                        new PrivateChannel('channel-name'),
                    ];
                }
                /**
                 * The name of the queue on which to place the broadcasting job.
                 */
                public function broadcastQueue(): string
                {
                    return 'low';
                }
            }

        PHP);
    }
}
