<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Notifications\EventReminder;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use App\Mail\EventReminderMail; // Add this line to import the 'EventReminderMail' class
use Illuminate\Support\Facades\Mail; // Add this line to import the 'Mail' class

class SendEventReminders extends Command
{
    protected $signature = 'send:event-reminders';

    protected $description = 'Send reminder emails for upcoming events';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();
        $upcomingEvents = Event::whereBetween('event_date', [$now->copy()->addDay(), $now->copy()->addDays(2)])->get();

        foreach ($upcomingEvents as $event) {
            foreach ($event->subscribers as $user) {
                Mail::to($user->email)->send(new EventReminderMail($event, $user));
            }
        }

        return 0;
    }
}
