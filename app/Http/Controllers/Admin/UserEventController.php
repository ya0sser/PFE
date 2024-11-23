<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\GuestSubscription;

class UserEventController extends Controller
{
    public function index()
    {
        $userEvents = DB::table('event_user')
            ->join('users', 'event_user.user_id', '=', 'users.id')
            ->join('events', 'event_user.event_id', '=', 'events.id')
            ->select('event_user.user_id', 'users.name as user_name', 'users.email as user_email', 'users.phone as user_phone', 'event_user.event_id', 'events.title as event_name', 'event_user.created_at')
            ->get();

        $guestEvents = GuestSubscription::with('event')->get();

        $users = User::where('is_admin', false)->get();
        $events = Event::all();

        return view('adminDashboard.UserEvent', compact('userEvents', 'guestEvents', 'users', 'events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);

        $exists = DB::table('event_user')
            ->where('user_id', $request->user_id)
            ->where('event_id', $request->event_id)
            ->exists();

        if ($exists) {
            return redirect()->route('user-event.index')->with('error', 'User is already subscribed to this event.');
        }

        DB::table('event_user')->insert([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('user-event.index')->with('success', 'User added to event successfully.');
    }

    public function destroy($userId, $eventId)
    {
        DB::table('event_user')
            ->where('user_id', $userId)
            ->where('event_id', $eventId)
            ->delete();

        return redirect()->route('user-event.index')->with('success', 'Subscription deleted successfully.');
    }

    public function destroyGuest($guestSubscriptionId)
    {
        $guestSubscription = GuestSubscription::findOrFail($guestSubscriptionId);
        $guestSubscription->delete();

        return redirect()->route('user-event.index')->with('success', 'Guest subscription deleted successfully.');
    }

    public function show($userId, $eventId)
    {
        $userEvent = DB::table('event_user')
            ->join('users', 'event_user.user_id', '=', 'users.id')
            ->join('events', 'event_user.event_id', '=', 'events.id')
            ->select('event_user.*', 'users.name as user_name', 'users.phone as user_phone', 'events.title as event_name')
            ->where('event_user.user_id', $userId)
            ->where('event_user.event_id', $eventId)
            ->first();

        return view('adminDashboard.user-event-detail', compact('userEvent'));
    }

    public function downloadCsv()
    {
        $response = new StreamedResponse(function () {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['User Name', 'Email', 'Phone', 'Event Name', 'Subscription Date']);

            $userEvents = DB::table('event_user')
                ->join('users', 'event_user.user_id', '=', 'users.id')
                ->join('events', 'event_user.event_id', '=', 'events.id')
                ->select('users.name as user_name', 'users.email as user_email', 'users.phone as user_phone', 'events.title as event_name', 'event_user.created_at')
                ->get();

            $guestEvents = GuestSubscription::with('event')->get();

            foreach ($userEvents as $userEvent) {
                $createdAt = Carbon::parse($userEvent->created_at)->format('Y-m-d H:i:s');

                fputcsv($handle, [
                    $userEvent->user_name,
                    $userEvent->user_email,
                    $userEvent->user_phone,
                    $userEvent->event_name,
                    $createdAt,
                ]);
            }

            foreach ($guestEvents as $guestEvent) {
                $createdAt = Carbon::parse($guestEvent->created_at)->format('Y-m-d H:i:s');

                fputcsv($handle, [
                    $guestEvent->username,
                    $guestEvent->email,
                    $guestEvent->phone,
                    $guestEvent->event->title,
                    $createdAt,
                ]);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="user_events_' . date('Ymd_His') . '.csv"',
        ]);

        return $response;
    }
    
    
    
}
