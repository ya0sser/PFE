<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CheckEventSubscribers
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        $eventModel = $event->event;

        $totalSubscribers = $eventModel->getSubscribersCountAttribute();

        Log::info('Checking subscribers for event: ', [
            'event_id' => $eventModel->id, 
            'total_subscribers' => $totalSubscribers, 
            'max_subscribers' => $eventModel->max_subscribers
        ]);

        if ($totalSubscribers >= $eventModel->max_subscribers) {
            $eventModel->closed = true;
            Log::info('Event closed due to reaching max subscribers: ', ['event_id' => $eventModel->id]);
        } else {
            $eventModel->closed = false;
            Log::info('Event reopened as subscribers are less than max: ', ['event_id' => $eventModel->id]);
        }

        $eventModel->save();
    }
}
