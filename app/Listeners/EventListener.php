<?php

namespace App\Listeners;

use App\Events\MessagePublished;

class EventListener
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
     * @param MessagePublished $event
     *
     * @return void
     */
    public function handle(MessagePublished $event)
    {
        //
    }
}
