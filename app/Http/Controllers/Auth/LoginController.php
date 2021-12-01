<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Anzeige Login-Form
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function index()
    {
        if(Auth::check()) {
            return redirect()->route("admin");
        }
        return view("auth.index");
    }

    /**
     * Login-Request ausführen. Passwort validieren.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function submitLogin(LoginRequest $request) {
        $adminUser = config("app.default_admin_user");
        if(Auth::attempt(['username' => $adminUser,'password' => $request->get('password')],true)) {
            return redirect()->route("index");
        }
        return redirect()->back()
            ->withErrors(['Das Passwort ist nicht korrekt.']);
    }

    /**
     * Abmeldung aus dem Administrationsbereich durchführen.
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route("index");
    }
}
