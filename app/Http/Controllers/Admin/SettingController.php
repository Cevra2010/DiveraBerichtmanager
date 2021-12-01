<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLogoRequest;
use App\Http\Requests\StorePasswordRequest;
use App\Http\Requests\StoreSettingRequest;
use App\Models\User;
use Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Storage;
use Zis\Ext\SettingsManager\Setting;

class SettingController extends Controller
{
    /**
     * Anzeige der View
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $organisation = Setting::get('organisation');
        $alarm_api_key = Setting::get('alarm_api_key');

        if(!$logo = Storage::exists(Setting::get('logo'))) {
            $logo = null;
        }
        else {
            $logo = Storage::url(Setting::get('logo'));
        }

        return view("admin.setting.index",compact([
            'logo',
            'organisation',
            'alarm_api_key',
        ]));
    }

    /**
     * Speichert die gesetzten Einstellungen in der Datenbank
     *
     * @param StoreSettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSetting(StoreSettingRequest $request): \Illuminate\Http\RedirectResponse
    {
        Setting::set('organisation',$request->get('organisation'));
        Setting::set('alarm_api_key',$request->get("alarm_api_key"));
        session()->flash('success','Die Einstellungen wurden gespeichert.');
        return redirect()->back();
    }

    /**
     * Speichert das gesetzte Passwort auf den, in den Einstellungen definierten Admin-Benutzer.
     *
     * @param StorePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePassword(StorePasswordRequest $request)
    {
        $user = User::where('username',config('app.default_admin_user'))->firstOrFail();
        $user->password = Hash::make($request->get('password'));
        $user->save();
        session()->flash('success','Das Passwort wurde geändert.');
        return redirect()->back();
    }

    /**
     * Speichert das Logo
     *
     * @param StoreLogoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLogo(StoreLogoRequest $request) {
        $path = $request->file('logo')->store('public/logo');
        if(Setting::get('logo')) {
            Storage::delete(Setting::get('logo'));
        }
        Setting::set('logo',$path);
        session()->flash('success','Das Logo wurde gespeichert.');
        return redirect()->route('admin.setting');
    }

    /**
     * Setzt das Logo zum Standartlogo zurück.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetLogo() {
        if(Setting::get('logo')) {
            Storage::delete(Setting::get('logo'));
        }
        Setting::set('logo',null);
        session()->flash('success','Das Logo wurde zurückgesetzt.');
        return redirect()->back();
    }

    /**
     * Funktionen anzeigen / bearbeiten / löschen
     *
     * @return Application|Factory|View
     */
    public function funktionen() {
        return view("admin.setting.funktionen");
    }

    /**
     * Positionen anzeigen / bearbeiten / löschen
     *
     * @return Application|Factory|View
     */
    public function positionen() {
        return view("admin.setting.positionen");
    }
}
