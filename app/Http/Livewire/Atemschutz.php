<?php

namespace App\Http\Livewire;

use App\Models\Bericht;
use App\Models\Personal;
use Livewire\Component;

class Atemschutz extends Component
{
    public $bericht;

    public $listeners = [
        'atemschutz_updated' => '$refresh',
    ];

    public function mount(Bericht $bericht) {
        $this->bericht = $bericht;
    }

    public function render()
    {
        $atemschutz = \App\Models\Atemschutz::where('bericht_id',$this->bericht->id)->get();
        return view('livewire.atemschutz',[
            'atemschutz' => $atemschutz,
        ]);
    }

    public function atemschutzAdd(Personal $personal) {
        $atemschutz = new \App\Models\Atemschutz();
        $atemschutz->bericht_id = $this->bericht->id;
        $atemschutz->personal_id = $personal->id;
        $atemschutz->save();
        $this->emit('openAtem',$atemschutz->id);
    }

    public function delAtemschutz(\App\Models\Atemschutz $atemschutz) {
        $atemschutz->delete();
    }
}
