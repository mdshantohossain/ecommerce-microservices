<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('website.user.index', compact('user'));
    }
}
