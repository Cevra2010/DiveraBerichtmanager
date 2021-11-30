<?php

namespace App\Http\Livewire;

use App\Models\Funktionen;
use Livewire\Component;

class CreateFunktionForm extends Component
{

    public $name;
    public $rules = [
        'name' => 'required|unique:funktionens',
    ];

    public function render()
    {
        return view('livewire.create-funktion-form');
    }

    public function submit() {
        $this->validate();

        if($lastOrder = Funktionen::orderBy('order','desc')->first()) {
            $order = $lastOrder->order + 1;
        }
        else {
            $order = 1;
        }
        $funktion = new Funktionen();
        $funktion->name = $this->name;
        $funktion->order = $order;
        $funktion->save();
        $this->name = null;
        $this->emit('funktionen_updated');
    }
}
