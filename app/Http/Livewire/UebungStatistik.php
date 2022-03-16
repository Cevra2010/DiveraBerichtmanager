<?php

namespace App\Http\Livewire;

use App\Models\Alarm;
use App\Models\Bericht;
use App\Models\Personal;
use Carbon\Carbon;
use Livewire\Component;

class UebungStatistik extends Component
{

    public $year;
    public $alarms;

    public function mount() {
        $this->year = Carbon::now()->year;
        $this->generate();
    }

    public function render()
    {
        $this->generate();
        $personal = Personal::all();
        return view('livewire.uebung-statistik',[
            'personal' => $personal,
        ]);
    }

    public function generate() {
        $first = Carbon::now()->setYear($this->year)->firstOfYear();
        $last = Carbon::now()->setYear($this->year)->lastOfYear();
        $this->alarms = Alarm::whereBetween('closed_at',[$first,$last])->where('is_uebung',1)->get();
    }

    public function addYear() {
        $this->year++;
    }

    public function subYear() {
        $this->year--;
    }

    public function countUebung(Personal $person) {
        $count = 0;

        foreach($this->alarms as $alarm) {
            foreach($alarm->bericht->personal as $personal) {
                if($personal->id == $person->id) {
                    $count++;
                }
            }
        }

        return $count;
    }
}
