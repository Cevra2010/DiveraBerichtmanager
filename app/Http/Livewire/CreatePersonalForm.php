<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use Livewire\Component;

class CreatePersonalForm extends Component
{
    public $personal = null;
    public $showForm = false;
    public $showDeleteConfirmation = false;

    protected $rules = [
        'personal.firstname' => 'required',
        'personal.lastname' => 'required',
        'personal.gf' => 'nullable|required',
    ];

    protected $listeners = [
        'select_personal' => 'select',
    ];

    public function mount() {
        $this->abort();
    }

    public function render()
    {
        return view('livewire.create-personal-form');
    }

    public function select(Personal $personal) {
        $this->showForm = true;
        $this->personal = $personal;
    }

    public function abort() {
        $this->personal = new Personal();
        $this->personal->gf = 0;
        $this->showForm = false;
    }

    public function submit() {
        $this->validate();
        $this->personal->save();
        $this->abort();
        $this->emit("personal_updated");
    }

    public function addPersonal() {
        $this->abort();
        $this->showForm = true;
    }

    public function delete() {
        if($this->personal && $this->personal->id) {
            $this->showDeleteConfirmation = true;
        }
    }

    public function confirmDelete() {
        $this->personal->delete();
        $this->abort();
        $this->showDeleteConfirmation = false;
        $this->emit("personal_updated");
    }

    public function abortDelete() {
        $this->showDeleteConfirmation = false;
    }
}
