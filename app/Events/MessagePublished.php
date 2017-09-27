<?php

namespace App\Events;

use Cmgmyr\Messenger\Models\Message;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessagePublished extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $action;
    public $message;
    public $receiver;
    public $sender;
    public $counters;
    public $params = [];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message, $receiver, $counters, $action = 'newMessage', $params = [])
    {
        $this->message = $message;
        $this->sender = $message->user;
        $this->receiver = $receiver;
        $this->action = $action;
        $this->counters = $counters;
        $this->params = array_merge($this->params, $params);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [$this->receiver->username.'-messenger'];
    }
}
