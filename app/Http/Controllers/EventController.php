<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Events\SubscriptionAdded;
use App\Models\GuestSubscription;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index() {
        $events = Event::withCount('subscribers')->paginate(9); 
        return view('pages.events', compact('events'));
    }

    public function landing() {
        return view('pages.landing');
    }
    public function unsubscribe(Request $request, $eventId) {
        $event = Event::findOrFail($eventId);
    
        if (!auth()->check()) {
            return redirect()->route('login');
        }
    
        $user = auth()->user();
        $event->subscribers()->detach($user->id);
    
        return redirect()->route('events.show', ['id' => $eventId])->with('success', 'Vous avez annulé votre inscription avec succès.');
    }
    
    public function show($id) {
        $event = Event::findOrFail($id);
        $otherDates = Event::where('title', $event->title)
                            ->where('id', '!=', $id)
                            ->orderBy('event_date')
                            ->get();
        $isSubscribed = false;
    
        if (auth()->check()) {
            $isSubscribed = $event->subscribers()->where('user_id', auth()->id())->exists();
        }
    
        return view('pages.pathway', compact('event', 'otherDates', 'isSubscribed'));
    }
    
    
    

    public function subscribe(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        if ($event->closed) {
            return back()->with('error', 'This event is closed for new subscriptions.');
        }

        if (!Auth::check()) {
            return redirect()->route('subscribe.guest', ['eventId' => $eventId]);
        }

        $user = Auth::user();
        $subscriptionExists = $event->subscribers()->where('user_id', $user->id)->exists();

        if ($subscriptionExists) {
            return back()->with('info', 'You are already subscribed to this event.');
        }

        $event->subscribers()->attach($user->id, [
            'user_name' => $user->name,
            'event_name' => $event->title,
        ]);

        event(new SubscriptionAdded($event));

        return redirect()->route('events.show', ['id' => $eventId])->with('success', 'You have been successfully subscribed.');
    }
    
    
    
    
    

    public function showCalendar() {
        return view('pages.calendar');
    }

    public function payment($eventId) {
        $event = Event::findOrFail($eventId);
        if ($event->closed) {
            return redirect()->back()->with('error', 'This event is currently closed for new subscriptions.');
        }
        return view('components.payment', compact('event'));
    }

    public function attemptSubscribe($eventId)
    {
        if (!Auth::check()) {
            session(['url.intended' => route('subscribe.after.login', ['eventId' => $eventId])]);
            return redirect()->route('login');
        }
    
        return $this->handleSubscription($eventId);
    }
    
    public function handleSubscription($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = Auth::user();
    
        if ($event->closed) {
            return redirect()->route('events.show', ['id' => $eventId])->with('error', 'This event is closed for new subscriptions.');
        }
    
        $subscriptionExists = $event->subscribers()->where('user_id', $user->id)->exists();
        if ($subscriptionExists) {
            return redirect()->route('events.show', ['id' => $eventId])->with('info', 'You are already subscribed to this event.');
        }
    
        $event->subscribers()->attach($user->id);

        event(new SubscriptionAdded($event));

        return redirect()->route('events.show', ['id' => $eventId])->with('success', 'You have been successfully subscribed.');
    }
    
    public function redirectToRegister() {
        session(['url.intended' => url()->previous()]);
        return redirect()->route('register');
    }

    public function processPayment(Request $request, $eventId) {
        $event = Event::findOrFail($eventId);
        return redirect()->route('components.payment', ['eventId' => $eventId])->with('success', 'Payment processed successfully!');
    }

    public function getEvents() {
        $events = Event::all();
        return response()->json($events->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->event_date->toIso8601String(),
                'end' => $event->event_date->addHours(2)->toIso8601String(),
                'allDay' => false
            ];
        }));
    }
    
    public function showGuestSubscribeForm($eventId) {
        $event = Event::findOrFail($eventId);
        return view('subscribe-guest', compact('eventId'));
    }
    
    public function subscribeGuest(Request $request, $eventId)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'username' => 'required|string',
            'phone' => 'required|string',
        ]);
    
        $event = Event::findOrFail($eventId);
    
        if ($event->closed) {
            return back()->with('error', 'This event is closed for new subscriptions.');
        }
    
        // Logique pour enregistrer la souscription
        $subscription = new GuestSubscription();
        $subscription->email = $validated['email'];
        $subscription->username = $validated['username'];
        $subscription->phone = $validated['phone'];
        $subscription->event_id = $event->id;
        $subscription->save();
        
        event(new SubscriptionAdded($event));

        if ($event->price > 0) {
            return redirect()->route('components.payment', ['eventId' => $event->id])->with('success', 'Please complete the payment to finalize your subscription.');
        }
    
        return redirect()->route('events.show', ['id' => $eventId])->with('success', 'You have been subscribed successfully!');
    }
    
    
}
