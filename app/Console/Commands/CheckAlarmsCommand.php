<?php

namespace App\Console\Commands;

use App\Models\Alarm;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Zis\Ext\DiveraRequest\DiveraRequest;
use Zis\Ext\SettingsManager\Setting;

class CheckAlarmsCommand extends Command
{
    protected $signature = 'check_alarms';

    protected $description = 'Command description';

    public function handle()
    {
        if(Setting::get('alarm_api_key')) {
            $request = new DiveraRequest(Setting::get('alarm_api_key'));
            $request->method('alarms');
            $result = $request->execute();
            foreach($result["items"] as $item) {
                if(!Alarm::where('alarm_id',$item["id"])->count()) {
                    $alarm = new Alarm();
                    $alarm->alarm_id = $item["id"];
                    $alarm->einsatz_nr = $item["foreign_id"];
                    $alarm->address = $item["address"];
                    $alarm->stichwort = $item["title"];
                    $alarm->bemerkung = $item["text"];
                    $alarm->alarm_at = Carbon::createFromTimestamp($item["ts_create"]);
                    $alarm->save();
                }
            }
        }
    }
}
