<?php

namespace App\Events;

use App\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NotificationPublished extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $notification;
    public $username;
    public $notified_from;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notification $notification, $notified_from, $username)
    {
        $this->notification = $notification;
        $this->username = $username;
        $this->notified_from = $notified_from;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [$this->username->username.'-notification-created'];
    }
}
