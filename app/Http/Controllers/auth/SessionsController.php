<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    /**
 * Handle an authentication attempt.
 *
 * @param  \Illuminate\Http\Request $request
 *
 * @return Response;
 */

 public function index() {
    return view("auth.session");
 }

public function authenticate(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Authentication passed...
        return redirect()->intended('/');
    }
}


public function logout()
{
    Auth::logout();

    return redirect('/');
}
}
