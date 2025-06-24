<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Generate token
    $token = $user->createToken('admin-login')->plainTextToken;

    // Redirect to dashboard with token in cookie
    return redirect()->to('/redirect-after-login')->withCookie(cookie('auth_token', $token, 60));
});
