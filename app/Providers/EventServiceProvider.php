<?php

namespace App\Providers;

use App\Notification;
use App\Observers\MessageObserver;
use App\Observers\NotificationObserver;
use Cmgmyr\Messenger\Models\Message;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\MessagePublished' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\NotificationPublished' => [
            'App\Listeners\NotificationEventListener',
        ],
        'Illuminate\Auth\Events\Registered' => [

        ],
        
    ];

    protected $subscribe = [
        'App\Listeners\WalletRegisteredUser'
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Notification::observe(new NotificationObserver());
        // Message::observe(new MessageObserver());
    }
}