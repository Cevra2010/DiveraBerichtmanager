<?php

namespace Zis\Ext\SettingsManager;

use Illuminate\Database\Eloquent\Model;


/**
 * @property mixed $setting_value
 * @property mixed $setting_key
 */
class SettingModel extends Model {
    protected $table = 'settings';
}
