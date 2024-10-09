<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

class UpdateLastAction
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        // Check if the user is a Customer and update `last_action`
        if ($user instanceof \App\Models\Customer) {
            $user->last_action = now();
            $user->save();
        }
    }
}
