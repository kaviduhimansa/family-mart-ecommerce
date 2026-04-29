<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
        ->with(['prompt' => 'select_account'])
        ->redirect();
    }

    /**
     * Obtain the user information from Google and log them in.
     */
    public function handleGoogleCallback()
    {
        try {
            // Retrieve user info from Google
            $googleUser = Socialite::driver('google')->user();
            
            // If the user doesn't exist in our database, create them
            $user = User::updateOrCreate([
                'email' => $googleUser->email,
            ], [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'password' => bcrypt('12345678') // Default dummy password
            ]);

            // Log the user into the application
            Auth::login($user);

            return redirect()->route('home')->with('success', 'Logged in with Google successfully!');

        } catch (\Exception $e) {
            // Redirect back to login if something goes wrong
            return redirect('/login')->with('error', 'Google authentication failed. Please try again.');
        }
    }
}