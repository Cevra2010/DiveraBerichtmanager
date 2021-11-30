<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use Livewire\Component;

class PersonalTable extends Component
{
    public $listeners = [
        'personal_updated' => '$refresh',
    ];

    public function render()
    {
        $personal = Personal::all();
        return view('livewire.personal-table',compact('personal'));
    }
}
