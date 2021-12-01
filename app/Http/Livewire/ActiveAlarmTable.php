<?php

namespace App\Http\Livewire;

use App\Models\Alarm;
use Livewire\Component;

class ActiveAlarmTable extends Component
{
    /**
     * Rückgabe der View
     * Alle aktuell, nicht geschlossenen Alarm in Tabelleform darstellen
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $alarms = Alarm::where('closed_at',null)->get();
        return view('livewire.active-alarm-table',[
            'alarms' => $alarms,
        ]);
    }
}
