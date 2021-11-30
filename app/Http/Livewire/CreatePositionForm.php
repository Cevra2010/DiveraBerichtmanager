<?php

namespace App\Http\Livewire;

use App\Models\Position;
use Livewire\Component;

class CreatePositionForm extends Component
{
    public $name;
    public $rules = [
        'name' => 'required|unique:positions',
    ];

    public function render()
    {
        return view('livewire.create-position-form');
    }

    public function submit() {
        $this->validate();

        if($lastOrder = Position::orderBy('order','desc')->first()) {
            $order = $lastOrder->order + 1;
        }
        else {
            $order = 1;
        }
        $position = new Position();
        $position->name = $this->name;
        $position->order = $order;
        $position->save();
        $this->name = null;
        $this->emit('positionen_updated');
    }
}
