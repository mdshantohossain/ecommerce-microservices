<?php

namespace App\Http\Controllers;

use App\Models\AppCredential;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookLogin()
    {
        $facebookUser = Socialite::driver('facebook')->user();

        return redirect('/')->with('success', 'Login successfully');
    }
}
