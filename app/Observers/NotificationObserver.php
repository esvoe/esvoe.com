<?php

namespace App\Observers;

use App\Events\NotificationPublished;
use App\User;
use Event;

/**
 * Observes the Users model.
 */
class NotificationObserver
{
    /**
     * Function will be triggerd when a Notification is updated.
     *
     * @param Users $model
     */
    public function created($model)
    {
        $notify_user = User::findOrFail($model->user_id);
        $notified_from = $model->notified_from()->first()->toArray();
        Event::fire(new NotificationPublished($model, $notified_from, $notify_user));
    }
}
