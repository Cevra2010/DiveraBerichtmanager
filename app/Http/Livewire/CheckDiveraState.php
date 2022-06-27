<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Zis\Ext\DiveraRequest\DiveraRequest;
use Zis\Ext\SettingsManager\Setting;

class CheckDiveraState extends Component
{

    public $state = null;

    /**
     * Wiedergabe der View
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.check-divera-state');
    }

    /**
     *  Divera-Status in Bezug auf den angegebenen Access-Key prüfen und den Status der Verbindung setzen.
     */
    public function checkState() {
        $request = new DiveraRequest(Setting::get('alarm_api_key'));
        $request->method('alarms');
        if(!$request->execute()) {
            if($request->getErrorCode() == "connection") {
                $this->state = "connection";
            }
            elseif($request->getErrorCode() == "forbidden") {
                $this->state = false;
            }
        }
        else {
            $this->state = true;
        }
    }
}
