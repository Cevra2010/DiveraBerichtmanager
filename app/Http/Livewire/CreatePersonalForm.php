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
        'personal.visible' => 'nullable|required',
        'personal.email' => 'nullable|email',
        'personal.arbeit' => 'nullable',
    ];

    protected $listeners = [
        'select_personal' => 'select',
    ];

    /**
     *  Formular zurücksetze
     */
    public function mount() {
        $this->abort();
    }

    /**
     * Rückgabe der View
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.create-personal-form');
    }

    /**
     * Personal auswählen
     *
     * @param Personal $personal
     */
    public function select(Personal $personal) {
        $this->showForm = true;
        $this->personal = $personal;
    }

    /**
     *  Formular zurücksetzen
     */
    public function abort() {
        $this->personal = new Personal();
        $this->personal->gf = 0;
        $this->personal->visible = 1;
        $this->showForm = false;
    }

    /**
     *  Eingabe speichern.
     */
    public function submit() {
        $this->validate();
        $this->personal->save();
        $this->abort();
        $this->emit("personal_updated");
    }

    /**
     *  Formular zu erstellung neuen Personals anzeigeb
     */
    public function addPersonal() {
        $this->abort();
        $this->showForm = true;
    }

    /**
     *  Personal löschen dialog anzeigen
     */
    public function delete() {
        if($this->personal && $this->personal->id) {
            $this->showDeleteConfirmation = true;
        }
    }

    /**
     *  Personal löschen.
     *  Tabelle neu laden.
     */
    public function confirmDelete() {
        $this->personal->delete();
        $this->abort();
        $this->showDeleteConfirmation = false;
        $this->emit("personal_updated");
    }

    /**
     *  Personal löschen Dialog abbrechen.
     */
    public function abortDelete() {
        $this->showDeleteConfirmation = false;
    }
}
