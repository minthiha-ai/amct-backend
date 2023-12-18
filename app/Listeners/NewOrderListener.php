<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\NewOrderEvent;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrderListener
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
    public function handle(NewOrderEvent $event)
    {
        //notify to all admin
        User::get()->each(function($admin) use ($event){
            $admin->notify(new NewOrderNotification($event->data));
        });
    }
}