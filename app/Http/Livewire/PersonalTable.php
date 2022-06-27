<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use Livewire\Component;

class PersonalTable extends Component
{
    public $listeners = [
        'personal_updated' => '$refresh',
    ];

    /**
     * View zurückgeben
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $personal = Personal::all();
        return view('livewire.personal-table',compact('personal'));
    }
}
