<?php

namespace App\Http\Livewire;

use App\Mail\EinsatzberichtFinished;
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

    /**
     * Validierungsfehler
     *
     * @var array
     */
    public $validationErrors = [];

    /**
     * Bericht-ID
     *
     * @var
     */
    public $bericht_id;

    /**
     * E-Mail Adresse ( für Divera-Login )
     *
     * @var
     */
    public $email;

    /**
     * Passwort ( für Divera-Login )
     *
     * @var
     */
    public $password;

    /**
     * Übungsbericht ja/nein
     *
     * @var
     */
    public $uebung = false;

    /**
     * Admin-Archiv
     * @var
     */
    public $archivQuestion = false;

    /**
     * Löst die Prüfung auf Validationsfehler aus und gibt die View zurück.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->checkValidationErrors();
        return view('livewire.bericht-finish');
    }

    /**
     * Zeigt die confirmation an
     */
    public function archiv() {
        if(auth()->check()) {
            $this->archivQuestion = true;
        }
    }

    /**
     * Speichert den Bericht ohne weitere Angaben
     *
     * @return false|void
     */
    public function archivConfirmed() {
        if($this->archivQuestion != true) {
            return false;
        }

        $this->finishBericht(false);

    }

    /**
     * Initiale registrierung der Bericht-ID
     *
     * @param Bericht $bericht
     */
    public function mount(Bericht $bericht) {
        $this->bericht_id = $bericht->id;
    }

    /**
     *  Prüft den aktuellen Bericht auf vollständigkeit der Pflictfeler.
     *  Werden Fehler gefunden, werden die im array registriert.
     */
    public function checkValidationErrors() {
        $this->validationErrors = [];
        $bericht = Bericht::find($this->bericht_id);
        if($bericht->alarm->is_uebung)
        {
            $this->uebung = true;
        }

        if (!$bericht->text_2) {
            $this->validationErrors[] = 'Das Pflichtfeld "Tätigkeiten der Feuerwehr" ist nicht ausgefüllt.';
        }

    }

    /**
     *  Übermittlung der Formulareingabe zum Abschluss des Einsatzes
     *  Validierung der Anmeldedaten per Divera247 API
     *
     */
    public function submit() {
        if($this->uebung) {
            return $this->finishBericht(false);
        }
        else {
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
            if ($diveraRequest->getErrorCode() == "connection") {
                return $this->finishBericht(false);
            }

            if (!$result) {
                return session()->flash('custom_error', 'Login war nicht erfolgreich.');
            } else {
                return $this->finishBericht();
            }
        }
    }

    /**
     *  Bericht fertigstellen und diesen per API-Rquest in das "report"-Feld des Alarms
     *  bei Divera247 setzen.
     */
    private function finishBericht($connectionEstablished = true) {
        $bericht = Bericht::find($this->bericht_id);
        $text = $this->generateBerichtText($this->email);

        if($connectionEstablished && $bericht->alarm->alarm_id != null) {
            $diveraRequest = new DiveraRequest(Setting::get('alarm_api_key'));
            $diveraRequest->put('alarms/' . $bericht->alarm->alarm_id);
            $diveraRequest->setData(['Alarm' => [
                'report' => $text,
            ]]);
            $diveraRequest->execute();
        }
        $bericht->alarm->closed_at = Carbon::now();
        $bericht->gesamtbericht = $text;
        $bericht->save();
        $bericht->alarm->save();
        try {
            \Mail::to(Setting::get("email_reporting_to"))->send(new EinsatzberichtFinished($bericht->gesamtbericht));
        }
        catch(\Exception $e) {
            session()->flash('custom_error','E-Mail-Versand ist fehlgeschlagen.');
        }
        session()->flash('success','Der Bericht wurde erfolgreich gespeichert.');
        return $this->redirect("/");
    }


    /**
     * Generation des Bericht-Textes für das Divera247 "report"-Feld
     *
     * @param null $signatur Signatur ( E-Mail Adresse ) für den Bericht
     * @return string Einsatzbericht in Textform
     */
    private function generateBerichtText($signatur = null)
    {

        $bericht = Bericht::find($this->bericht_id);
        $atemschutz = \App\Models\Atemschutz::where('bericht_id',$bericht->id)->get();
        $text = '';

        if ($bericht->alarm->is_uebung)
        {
            $text = "\n\n *** Übungsbericht *** \n\n";
            $text .= "besonderheiten zum Übungsdienst:\n";
            $text .= $bericht->text_2;
            $text .= "\n\n";
        }
        else {


            $text = "\n\n *** Einsatzbericht *** \n\n";

            if ($bericht->hauptbericht) {
                $text .= "[ X ] Hauptbericht\n";
                $text .= "[   ] Nebenbericht\n\n";

            } else {
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
            if ($signatur) {
                $text .= $signatur;
            } else {
                $text .= '*** Bericht noch nicht unterzeichnet ***';
            }

            $text .= "\n\n";
            $text .= "*** Personaleinsatz ***\n";
            $text .= "\n";
        }

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

        /**
         * Atemschutz
         */
        $text .= "*** Atemschutz ***";
        $text .= "\n";
        $text .= "\n";
        if($atemschutz->count()) {
            foreach($atemschutz as $atem) {
                $text .= "### ".$atem->personal->lastname.", ".$atem->personal->firstname."### \n";
                $text .= "Gerät: ".$atem->geraet_nr." => ".$atem->minutes." Minute/n\n";
                $text .= "Tätigkeit: ".$atem->tatigkeit."\n";
                $text .= "\n";
            }
        }
        else {
            $text .= "- Es wurde keine Kräfte unter Atemschutz eingesetzt. -";
        }

        return $text;
    }

}
