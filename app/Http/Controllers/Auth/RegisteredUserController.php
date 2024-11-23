<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (!session()->has('url.intended') && url()->previous() != url()->route('register')) {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.register');
    }
    
    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
    
        Auth::login($user);
        session()->flash('success', 'Registration successful. You are now logged in and you can subscribe to the Event.');
    
        $eventId = session('event_id');
        $event = Event::find($eventId);
        if ($event) {
            if ($event->price == 0) {
                $event->subscribers()->attach($user->id);
                return redirect()->route('events.show', ['id' => $eventId])->with('success', 'You have been successfully subscribed.');
            } else {
                return redirect()->route('components.payment', ['eventId' => $eventId]);
            }
        }
    
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    
    
}
