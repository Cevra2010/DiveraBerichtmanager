<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect()->route("admin");
        }
        return view("auth.index");
    }

    public function submitLogin(LoginRequest $request) {
        $adminUser = config("app.default_admin_user");
        if(Auth::attempt(['username' => $adminUser,'password' => $request->get('password')],true)) {
            return redirect()->route("index");
        }
        return redirect()->back()
            ->withErrors(['Das Passwort ist nicht korrekt.']);
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return redirect()->route("index");
    }
}
