<?php

namespace App\Listeners;

use App\Events\NotificationPublished;

class NotificationEventListener
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
     * @param NotificationPublished $event
     *
     * @return void
     */
    public function handle(NotificationPublished $event)
    {
        //
    }
}
