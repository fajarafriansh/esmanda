<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;

class GoogleController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request) {
        try {
            $user_google = Socialite::driver('google')->user();
            $user = User::where('email', $user_google->getEmail())->first();

            if (!$user) {
                $new_user = User::create([
                    'name' => $user_google->getName(),
                    'email' => $user_google->getEmail(),
                    'password' => bcrypt(Str::random(10)),
                ]);

                $new_user->roles()->sync([3]);
                Auth::login($new_user);

                return redirect()->route('home');
            }

            Auth::login($user);

            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->route('login')->with('message', $e->getMessage());
        }
    }
}
