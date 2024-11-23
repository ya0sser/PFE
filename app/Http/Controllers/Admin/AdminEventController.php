<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event; 
use App\Events\SubscriptionAdded;

class AdminEventController extends Controller
{
    public function index() {
        $events = Event::all(); 
        return view('adminDashboard.event', compact('events')); 
    }

    public function create() {
        return view('adminDashboard.event.create');
    }
    
    public function updateMaxSubscribers(Request $request, $id)
    {
        $request->validate([
            'max_subscribers' => 'required|integer|min:0',
        ]);
    
        $event = Event::findOrFail($id);
        $event->update([
            'max_subscribers' => $request->max_subscribers,
        ]);
    
        return redirect()->route('event-admin.index')->with('success', 'Max subscribers updated successfully.');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'Type_de_billet' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'max_subscribers' => 'required|integer|min:1',
            'map_url' => 'required|string|max:500',
        ]);

        $event = new Event([
            'title' => $request->title,
            'Type_de_billet' => $request->Type_de_billet,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'price' => $request->price,
            'duration' => $request->duration,
            'description' => $request->description,
            'closed' => false,
            'max_subscribers' => $request->max_subscribers,
            'map_url' => $request->map_url, 
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $event->image_path = 'images/' . $imageName;
        }

        $event->save();

        return redirect()->route('event-admin.index')->with('success', 'Event added successfully');
    }

    public function show($id) {
        $event = Event::findOrFail($id);
        return view('adminDashboard.event-detail', compact('event'));
    }

    public function edit($id) {
        $event = Event::findOrFail($id);
        return view('adminDashboard.event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
    
        $request->validate([
            'title' => 'required|string|max:255',
            'Type_de_billet' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'duration' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'map_url' => 'required|string|max:500', // Allow longer map URL
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'max_subscribers' => 'required|integer|min:1',
        ]);
    
        $event->title = $request->title;
        $event->Type_de_billet = $request->Type_de_billet;
        $event->event_date = $request->event_date;
        $event->location = $request->location;
        $event->duration = $request->duration;
        $event->price = $request->price;
        $event->description = $request->description;
        $event->map_url = $request->map_url; // Update map_url
        $event->max_subscribers = $request->max_subscribers;
    
        if ($request->hasFile('image')) {
            $oldImage = public_path($event->image_path);
            if (file_exists($oldImage)) {
                @unlink($oldImage);
            }
    
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $event->image_path = 'images/' . $imageName;
        }
    
        $event->save();
    
        return redirect()->route('event-admin.show', $id)->with('success', 'Event updated successfully!');
    }
    

    public function detail($id) {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->route('event-admin.index')->with('error', 'Event not found.');
        }
        return view('adminDashboard.event-detail', compact('event'));
    }

    public function destroy($id) {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('event-admin.index')->with('success', 'Event deleted successfully!');
    }

    // Method to add user to an event by admin and check for event closure
    public function addUserToEvent(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $userId = $request->input('user_id');
        $user = \App\Models\User::findOrFail($userId);

        // Check if the user is already subscribed
        if ($event->subscribers()->where('user_id', $userId)->exists()) {
            return redirect()->route('event-admin.show', $eventId)->with('error', 'User is already subscribed to this event.');
        }

        // Attach user to the event
        $event->subscribers()->attach($userId, ['user_name' => $user->name, 'event_name' => $event->title]);

        // Fire the event to check subscriber count
        event(new SubscriptionAdded($event));

        return redirect()->route('event-admin.show', $eventId)->with('success', 'User added to the event successfully!');
    }
}
