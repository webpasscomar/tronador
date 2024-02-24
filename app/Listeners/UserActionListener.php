<?php

    namespace App\Listeners;

    use App\Events\UserAction;
    use App\Models\Audit;
    use Carbon\Carbon;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Queue\InteractsWithQueue;


    /* creamos un listener para escuchar las acciones del usuario  del evento UserAction y guardar en la tabla Audits los registros de las mismas*/

    class UserActionListener
    {
        /**
         * Create the event listener.
         */
        public function __construct()
        {
            //
        }

        /**
         * Handle the event.
         */
        public function handle(UserAction $event)
        {
            Audit::create([
                'user_id' => $event->user->id,
                'action' => $event->action,
                'details' => $event->details,
                'modified_user_id' => $event->modifiedUser ? $event->modifiedUser : null,
                'created_at' => now(),
            ]);
        }
    }
