<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password as PasswordRule;

class NewPasswordController extends Controller
{    /**
    * Handle an incoming new password request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store(Request $request)
   {
       $request->validate([
           'token' => 'required',
           'email' => 'required|email',
           'password' => ['required', 'confirmed', PasswordRule::defaults()],
       ]);

       // Here we will attempt to reset the user's password. If it is successful we
       // will update the password on an actual user model and persist it to the
       // database. Otherwise we will parse the error and return the response.
       $status = Password::reset(
           $request->only('email', 'password', 'password_confirmation', 'token'),
           function ($user, $password) {
               $user->forceFill([
                   'password' => Hash::make($password),
               ])->save();

               $user->setRememberToken(Str::random(60));
           }
       );

       // If the password was successfully reset, we will redirect the user back to
       // the application's home authenticated view. If there is an error we can
       // redirect them back to where they came from with their error message.
       return $status == Password::PASSWORD_RESET
                   ? redirect()->route('login')->with('status', __($status))
                   : back()->withErrors(['email' => [__($status)]]);
   }
}
