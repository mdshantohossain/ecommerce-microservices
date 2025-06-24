<?php

namespace App\Http\Controllers;

use App\Models\AppCredential;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleLogin()
    {
        $googleUser = Socialite::driver('google')->user();


        return redirect('/')->with('success', 'Login successfully');
    }


}
