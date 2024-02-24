<?php

    namespace App\Events;

    use App\Models\User;
    use Illuminate\Broadcasting\Channel;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Broadcasting\PresenceChannel;
    use Illuminate\Broadcasting\PrivateChannel;
    use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;


    //Creamos un evento para manejar las acciones del usuario
    class UserAction
    {
        use Dispatchable, InteractsWithSockets, SerializesModels;

        public $user;
        public $action;
        public $details;
        public $modifiedUser;

        /**
         * Create a new event instance.
         */
        public function __construct(User $user, $action, $details, $modifiedUser = null)
        {
            $this->user = $user;
            $this->action = $action;
            $this->details = $details;
            $this->modifiedUser = $modifiedUser;
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
    }
