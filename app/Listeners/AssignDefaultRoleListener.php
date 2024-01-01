<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;


class AssignDefaultRoleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $defaultRole = Role::where('name', 'user')->first();
        $event->user->roles()->attach($defaultRole);
    }

}
