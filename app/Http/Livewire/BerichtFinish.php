<?php

namespace App\Http\Livewire;

use App\Models\Bericht;
use App\Models\BerichtRelationship;
use App\Models\Funktionen;
use Carbon\Carbon;
use Livewire\Component;
use PhpParser\Node\Expr\AssignOp\Div;
use Zis\Ext\DiveraRequest\DiveraRequest;
use Zis\Ext\SettingsManager\Setting;

class BerichtFinish extends Component
{

    public $validationErrors = [];
    public $bericht_id;
    public $email;
    public $password;

    public function render()
    {
        $this->checkValidationErrors();
        return view('livewire.bericht-finish');
    }

    public function mount(Bericht $bericht) {
        $this->bericht_id = $bericht->id;
    }

    public function checkValidationErrors() {
        $this->validationErrors = [];
        $bericht = Bericht::find($this->bericht_id);
        if(!$bericht->text_2)
        {
            $this->validationErrors[] = 'Das Pflichtfeld "Tätigkeiten der Feuerwehr" ist nicht ausgefüllt.';
        }
    }

    public function submit() {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $diveraRequest = new DiveraRequest(Setting::get('alarm_api_key'));
        $diveraRequest->method('auth/login');
        $diveraRequest->setData(['Login' => [
            'username' => $this->email,
            'password' => $this->password,
        ]]);
        $result = $diveraRequest->execute();
        if(!$result) {
            return session()->flash('custom_error','Login war nicht erfolgreich.');
        }
        else {
            $this->finishBericht();
        }
    }

    private function finishBericht() {
        $bericht = Bericht::find($this->bericht_id);
        $text = $this->generateBerichtText($this->email);
        $diveraRequest = new DiveraRequest(Setting::get('alarm_api_key'));
        $diveraRequest->put('alarms/'.$bericht->alarm->alarm_id);
        $diveraRequest->setData(['Alarm' => [
            'report' => $text,
        ]]);
        $diveraRequest->execute();
        $bericht->alarm->closed_at = Carbon::now();
        $bericht->alarm->save();
        session()->flash('success','Der Bericht wurde erfolgreich gespeichert.');
        return $this->redirect("/");
    }


    private function generateBerichtText($signatur = null) {

        $bericht = Bericht::find($this->bericht_id);
        $text = '';

        $text = "\n\n *** Einsatzbericht *** \n\n";

        if($bericht->hauptbericht) {
            $text .= "[ X ] Hauptbericht\n";
            $text .= "[   ] Nebenbericht\n\n";

        }
        else {
            $text .= "[   ] Hauptbericht\n";
            $text .= "[ X ] Nebenbericht\n\n";
        }
        $text .= "Lage beim Eintreffen:\n";
        $text .= $bericht->text_1;
        $text .= "\n\n";

        $text .= "Tätigkeiten der Feuerwehr:\n";
        $text .= $bericht->text_2;
        $text .= "\n\n";

        $text .= "Geschädigter:\n";
        $text .= $bericht->text_3;
        $text .= "\n\n";

        $text .= "Eigentümer:\n";
        $text .= $bericht->text_4;
        $text .= "\n\n";

        $text .= "Material:\n";
        $text .= $bericht->text_5;
        $text .= "\n\n";

        $text .= "Sonstiges:\n";
        $text .= $bericht->text_6;
        $text .= "\n\n";

        $text .= "Bericht digital Unterzeichnet durch:\n";
        if($signatur) {
            $text .= $signatur;
        }
        else {
            $text .= '*** Bericht noch nicht unterzeichnet ***';
        }

        $text .= "\n\n";
        $text .= "*** Personaleinsatz ***\n";
        $text .= "\n";

        foreach(Funktionen::orderBy('order')->get() as $funktion) {
            $text .= "--- " . $funktion->name . " ---\n";
            $relations = BerichtRelationship::where('bericht_id', $bericht->id)->where('funktion_id', $funktion->id)->get();
            if (count($relations))
            {
                foreach ($relations as $relation) {
                    $text .= $relation->personal->lastname . ", " . $relation->personal->firstname;
                    if($relation->position_id) {
                        $text .= " - ( ".$relation->position->name." ) ";
                    }
                    $text .= "\n";
                }
            }
            else {
                $text .= "- keine Besatzung -\n";
            }
            $text .= "\n";
        }

        return $text;
    }

}
