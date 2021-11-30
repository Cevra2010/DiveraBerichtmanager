<?php

namespace App\Http\Livewire;

use App\Models\Bericht;
use Livewire\Component;

class BerichtEditor extends Component
{
    public $section = "finish";
    public $bericht;

    public function mount(Bericht $bericht) {
        $this->bericht = $bericht;
    }

    public function render()
    {
        return view('livewire.bericht-editor');
    }

    public function setSection($sectionName) {
        $this->section = $sectionName;
    }
}
