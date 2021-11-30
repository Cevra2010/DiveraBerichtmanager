<?php

namespace App\Http\Livewire;

use App\Models\Alarm;
use Livewire\Component;

class ActiveAlarmTable extends Component
{
    public function render()
    {
        $alarms = Alarm::where('closed_at',null)->get();
        return view('livewire.active-alarm-table',[
            'alarms' => $alarms,
        ]);
    }
}
