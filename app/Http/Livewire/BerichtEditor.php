<?php

namespace App\Http\Livewire;

use App\Models\Bericht;
use Livewire\Component;

class BerichtEditor extends Component
{
    public $section = "atemschutz";
    public $bericht;

    public function mount(Bericht $bericht) {
        $this->bericht = $bericht;
    }

    /**
     * Rückgabe der View
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.bericht-editor');
    }

    /**
     * Setzt die Sektion, die anzeigt werden soll.
     *
     * @param $sectionName
     */
    public function setSection($sectionName) {
        $this->section = $sectionName;
    }
}
