<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AtemschutzEditor extends Component
{

    public $atemschutz = null;
    public $listeners = [
        'openAtem' => 'open',
    ];

    public $rules = [
        'atemschutz.minutes' => 'nullable',
        'atemschutz.geraet_nr' => 'nullable',
        'atemschutz.tatigkeit' => 'nullable',
    ];

    public function open(\App\Models\Atemschutz $atemschutz) {
        $this->atemschutz = $atemschutz;
    }

    public function render()
    {
        return view('livewire.atemschutz-editor');
    }

    public function submit() {
        $this->atemschutz->save();
        $this->atemschutz = null;
        $this->emit("atemschutz_updated");
    }
}
