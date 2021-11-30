<?php

namespace App\Http\Livewire;

use App\Models\Funktionen;
use Livewire\Component;

class FunktionManager extends Component
{

    protected $listeners = [
        'funktionen_updated' => '$refresh',
    ];

    public function render()
    {
        $funktionen = Funktionen::orderBy('order')->get();
        return view('livewire.funktion-manager',compact([
            'funktionen',
        ]));
    }

    public function orderUp(Funktionen $funktion) {
        if($upper = Funktionen::where('order','>',$funktion->order)->orderBy('order')->first()) {
            $upper->order = $upper->order - 1;
            $funktion->order = $upper->order + 1;
            $funktion->save();
            $upper->save();
        }
    }

    public function delete(Funktionen $funktion) {
        $upper = Funktionen::where('order','>',$funktion->order)->get();
        foreach($upper as $u)
        {
            $u->order = $u->order - 1;
            $u->save();
        }
        $funktion->delete();
        $this->emit("funktionen_updated");
    }

    public function orderDown(Funktionen $funktion) {
        if($lower = Funktionen::where('order','<',$funktion->order)->orderBy('order','desc')->first()) {
            $lower->order = $lower->order + 1;
            $funktion->order = $lower->order - 1;
            $funktion->save();
            $lower->save();
        }
    }
}
