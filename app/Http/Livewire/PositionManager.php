<?php

namespace App\Http\Livewire;

use App\Models\Position;
use Livewire\Component;

class PositionManager extends Component
{
    protected $listeners = [
        'positionen_updated' => '$refresh',
    ];

    public function render()
    {
        $positionen = Position::orderBy('order')->get();
        return view('livewire.position-manager',compact([
            'positionen',
        ]));
    }

    public function orderUp(Position $position) {
        if($upper = Position::where('order','>',$position->order)->orderBy('order')->first()) {
            $upper->order = $upper->order - 1;
            $position->order = $upper->order + 1;
            $position->save();
            $upper->save();
        }
    }

    public function delete(Position $position) {
        $upper = Position::where('order','>',$position->order)->get();
        foreach($upper as $u)
        {
            $u->order = $u->order - 1;
            $u->save();
        }
        $position->delete();
        $this->emit("positionen_updated");
    }

    public function orderDown(Position $position) {
        if($lower = Position::where('order','<',$position->order)->orderBy('order','desc')->first()) {
            $lower->order = $lower->order + 1;
            $position->order = $lower->order - 1;
            $position->save();
            $lower->save();
        }
    }
}
