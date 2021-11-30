<?php

namespace Zis\Ext\SettingsManager;

use Exception;

class Setting {

    private static $settings;

    /**
     * @throws Exception
     */
    public static function boot() {
        if(!self::loadSettingsFromDatabase()) {
            throw new Exception('Unable to Load Settings');
        }
    }

    public static function get($key) {
        $value = self::$settings->where("setting_key",$key)->first();
        if(isset($value->setting_key)) {
            return $value->setting_value;
        }
        return null;
    }

    public static function set($key,$value) : bool {
        if($set = self::$settings->where("setting_key",$key)->first()) {
            $set->setting_value = $value;
            $set->save();
        }
        else {
            $set = new SettingModel();
            $set->setting_key = $key;
            $set->setting_value = $value;
            $set->save();
            self::$settings->add($set);
        }
        return true;
    }

    private static function loadSettingsFromDatabase() : bool {
        try {
            self::$settings = SettingModel::all();
        }
        catch (Exception $exception) {
            return false;
        }
        return true;
    }
}
