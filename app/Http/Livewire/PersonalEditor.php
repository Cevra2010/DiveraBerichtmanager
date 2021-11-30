<?php

namespace App\Http\Livewire;

use App\Models\Bericht;
use App\Models\BerichtRelationship;
use App\Models\Funktionen;
use App\Models\Personal;
use App\Models\Position;
use Livewire\Component;

class PersonalEditor extends Component
{

    public $bericht;

    public function mount(Bericht $bericht) {
        $this->bericht = $bericht;
    }

    public function render()
    {
        $personal = Personal::orderBy('lastname')->get();
        $funktionen = Funktionen::orderBy('order')->get();
        $positionen = Position::orderBy('order')->get();
        $relationships = BerichtRelationship::where('bericht_id',$this->bericht->id)->get();

        return view('livewire.personal-editor')
            ->with([
                'relationships' => $relationships,
                'personal' => $personal,
                'funktionen' => $funktionen,
                'positionen' => $positionen,
            ]);
    }

    public function setFunktion(Personal $personal, Funktionen $funktion) {
        if($relationship = BerichtRelationship::where('bericht_id',$this->bericht->id)->where('personal_id',$personal->id)->first()) {
            $relationship->position_id = 0;
        }
        else {
            $relationship = new BerichtRelationship();
            $relationship->bericht_id = $this->bericht->id;
            $relationship->personal_id = $personal->id;
        }
        $relationship->funktion_id = $funktion->id;
        $relationship->save();

        $this->emit('$refresh');
    }

    public function unsetFunktion(Personal $personal) {
        if($relationship = BerichtRelationship::where('bericht_id',$this->bericht->id)->where('personal_id',$personal->id)->first()) {
            $relationship->delete();
        }
        $this->emit('$refresh');
    }

    public function setPosition(Personal $personal, Position $position) {
        // Bereits einer Funktion zugeordnet..
        $relationship = BerichtRelationship::where('personal_id',$personal->id)->where('bericht_id',$this->bericht->id)->first();
        if(!$relationship || !$relationship->funktion_id)
        {
            return session()->flash('custom_error','Bitte erst eine Funktion zuweisen.');
        }

        // Prüfen ob bereits anders Personal diese Funktion hat
        if(BerichtRelationship::where('bericht_id',$this->bericht->id)->where('funktion_id',$relationship->funktion_id)->where('position_id',$position->id)->count()) {
            return session()->flash('custom_error','Diese Position ist bereits vergeben.');
        }

        $relationship->position_id = $position->id;
        $relationship->save();

    }
}
