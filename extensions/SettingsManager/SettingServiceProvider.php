<?php

namespace Zis\Ext\SettingsManager;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__."/database/migration/");
    }

    public function boot()
    {
        Setting::boot();
    }
}
