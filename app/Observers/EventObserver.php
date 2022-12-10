<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\IncidentInfo;
use App\Traits\PushNotification;

class EventObserver
{
    use PushNotification;

    public function creating(Event $event)
    {
        $event->user_id = auth()->user();
    }

    /**
     * Handle the Event "created" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function created(Event $event)
    {
        $push_id = $this->createPushNotification($event->event_name, $event->start_date);

        $info = new IncidentInfo;
        $info->status = Event::TYPE_FUTURE;
        $info->frequency = 'one time';
        $info->push_id = $push_id;

        $event->save($info);
    }

    /**
     * Handle the Event "updated" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function updated(Event $event)
    {
        //
    }

    /**
     * Handle the Event "deleted" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function deleted(Event $event)
    {
        //
    }

    /**
     * Handle the Event "restored" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function restored(Event $event)
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function forceDeleted(Event $event)
    {
        //
    }
}
