<?php

namespace App\Http\Livewire;

use App\Models\Funktionen;
use Livewire\Component;

class FunktionManager extends Component
{

    protected $listeners = [
        'funktionen_updated' => '$refresh',
    ];

    /**
     * Rückgabe der View
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $funktionen = Funktionen::orderBy('order')->get();
        return view('livewire.funktion-manager',compact([
            'funktionen',
        ]));
    }

    /**
     *  Die Order eine position niedriger setzen und somit das Objekt höher anordnen.
     *
     * @param Funktionen $funktion
     */
    public function orderUp(Funktionen $funktion) {
        if($upper = Funktionen::where('order','>',$funktion->order)->orderBy('order')->first()) {
            $upper->order = $upper->order - 1;
            $funktion->order = $upper->order + 1;
            $funktion->save();
            $upper->save();
        }
    }

    /**
     * Funktion löschen
     *
     * @param Funktionen $funktion
     */
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

    /**
     * Ordnungszahl erhöhen und somit die FUnktion eine position tiefer setzen.
     *
     * @param Funktionen $funktion
     */
    public function orderDown(Funktionen $funktion) {
        if($lower = Funktionen::where('order','<',$funktion->order)->orderBy('order','desc')->first()) {
            $lower->order = $lower->order + 1;
            $funktion->order = $lower->order - 1;
            $funktion->save();
            $lower->save();
        }
    }
}
