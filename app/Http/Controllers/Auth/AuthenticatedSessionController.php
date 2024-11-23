<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        if (!session()->has('url.intended') && url()->previous() != url()->route('login')) {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.login');
    }

    public function createAdmin(): View
    {
        return view('adminDashboard.AdminLogin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            session()->flash('success', 'Login successful. You are now logged in and you can subscribe to the Event.');
    
            if ($request->filled('intended_url')) {
                session(['url.intended' => $request->intended_url]);
            }
    
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect. Please try again.',
        ]);
    }
    

    public function adminStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/customers');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Unauthorized access.']);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect()->route('adminDashboard.event');
        }
    
        return redirect('/');
    }
}



