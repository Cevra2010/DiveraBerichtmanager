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

    /**
     * Rückgabe der View
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.bericht-text-editor');
    }

    /**
     * Initiren des aktuellen Berichtes
     *
     * @param Bericht $bericht
     */
    public function mount(Bericht $bericht) {
        if(!$this->bericht->finished_at) {
            $this->bericht->finished_at = Carbon::now();
            $this->bericht->save();
        }
        $this->bericht = $bericht;
    }

    /**
     *  Bericht als Hauptbericht setzen
     */
    public function setHaupt() {
        $this->bericht->hauptbericht = 1;
        $this->bericht->save();
    }


    /**
     *  Bericht als Nebenbericht setzen.
     */
    public function setNeben() {
        $this->bericht->hauptbericht = 0;
        $this->bericht->save();
    }

    /**
     *  Aktuellen Bericht speichern. ( direkt nach Texteingabe )
     */
    public function updated() {
        $this->bericht->save();
    }
}
