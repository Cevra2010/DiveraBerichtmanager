<?php

namespace App\Http\Livewire;

use App\Models\Bericht;
use Carbon\Carbon;
use Livewire\Component;

class BerichtTextEditor extends Component
{

    public $bericht;
    protected $rules = [
        'bericht.text_1' => 'required',
        'bericht.text_2' => 'required',
        'bericht.text_3' => 'required',
        'bericht.text_4' => 'required',
        'bericht.text_5' => 'required',
        'bericht.text_6' => 'required',
    ];

    public function render()
    {
        return view('livewire.bericht-text-editor');
    }

    public function mount(Bericht $bericht) {
        if(!$this->bericht->finished_at) {
            $this->bericht->finished_at = Carbon::now();
            $this->bericht->save();
        }
        $this->bericht = $bericht;
    }

    public function setHaupt() {
        $this->bericht->hauptbericht = 1;
        $this->bericht->save();
    }

    public function setNeben() {
        $this->bericht->hauptbericht = 0;
        $this->bericht->save();
    }

    public function updated() {
        $this->bericht->save();
    }
}
