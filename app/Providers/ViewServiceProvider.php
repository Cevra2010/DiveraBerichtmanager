<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Zis\Ext\SettingsManager\Setting;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if(!$logo = Setting::get('logo')) {
            $logo = asset('img/logo.svg');
        }
        else {
            $logo = \Storage::url(Setting::get('logo'));
        }
        \view()->share('application_logo',$logo);
        \view()->share('application_organisation',Setting::get('organisation'));
    }
}
