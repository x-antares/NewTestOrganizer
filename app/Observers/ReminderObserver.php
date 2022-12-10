<?php

namespace App\Observers;

use App\Models\IncidentInfo;
use App\Models\Reminder;
use App\Traits\PushNotification;

class ReminderObserver
{
    use PushNotification;

    public function creating(Reminder $reminder)
    {
        $reminder->user_id = auth()->user();
    }

    /**
     * Handle the Reminder "created" event.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return void
     */
    public function created(Reminder $reminder)
    {
        $push_id = $this->createPushNotification($reminder->event_name, $reminder->date);

        $info = new IncidentInfo;
        $info->status = Reminder::TYPE_FUTURE;
        $info->frequency = 'one time';
        $info->push_id = $push_id;

        $reminder->save($info);
    }

    /**
     * Handle the Reminder "updated" event.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return void
     */
    public function updated(Reminder $reminder)
    {

    }

    /**
     * Handle the Reminder "deleted" event.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return void
     */
    public function deleted(Reminder $reminder)
    {
        //
    }

    /**
     * Handle the Reminder "restored" event.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return void
     */
    public function restored(Reminder $reminder)
    {
        //
    }

    /**
     * Handle the Reminder "force deleted" event.
     *
     * @param  \App\Models\Reminder  $reminder
     * @return void
     */
    public function forceDeleted(Reminder $reminder)
    {
        //
    }
}
