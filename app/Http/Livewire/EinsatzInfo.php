<?php

namespace App\Http\Livewire;

use App\Models\Bericht;
use App\Models\Personal;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Zis\Ext\SettingsManager\Setting;

class EinsatzInfo extends Component
{

    public $bericht = null;
    public $personal = null;
    public $alarm_at = null;
    public $alarm_end_at = null;
    public $einsatznummer = null;
    public $adressat = null;

    protected $rules = [
        'alarm_at' => 'required|date_format:d.m.Y H:i',
        'alarm_end_at' => 'required|date_format:d.m.Y H:i',
        'einsatznummer' => 'nullable|numeric',
    ];

    public function mount(Bericht $bericht = null) {
        $this->bericht = $bericht;
    }

    public function render()
    {
        return view('livewire.einsatz-info');
    }

    public function setPersonal(Personal $personal) {
        $this->alarm_at = $this->bericht->alarm->created_at->format("d.m.Y H:i");
        $this->alarm_end_at = $this->bericht->finished_at->format("d.m.Y H:i");
        $this->einsatznummer = $this->bericht->alarm->einsatz_nr;
        $this->personal = $personal;
    }

    public function abort() {
        $this->personal = null;
        $this->alarm_at = null;
        $this->alarm_end_at = null;
        $this->einsatznummer = null;
        $this->adressat = null;
    }

    public function generate() {
        $this->validate();
        session()->put('name',$this->personal->firstname." ".$this->personal->lastname);
        session()->put('alarm_at',$this->alarm_at);
        session()->put('alarm_end_at',$this->alarm_end_at);
        session()->put('einsatznummer',$this->einsatznummer);
        session()->put('adressat',$this->adressat);

        return redirect()->route("admin.bericht.bestaetigung.generate");
    }
}
