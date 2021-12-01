<?php

namespace App\Http\Controllers;

use App\Models\Alarm;
use App\Models\Bericht;

class BerichtController extends Controller
{
    /**
     * Anzeigen der Berichtübersicht
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view("bericht.index");
    }

    /**
     * Anzeigen eines bestimmten Berichtes nach ID
     *
     * @param Bericht $bericht
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Bericht $bericht) {
        return view("bericht.show",compact('bericht'));
    }

    /**
     * Bericht aus einer Alarm-Instanz erzeugen.
     *
     * @param Alarm $alarm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Alarm $alarm) {
        if($alarm->bericht) {
            return redirect()->route("bericht.show",$alarm->bericht);
        }

        $bericht = new Bericht();
        $bericht->start_at = $alarm->alarm_at;
        $bericht->alarm_id = $alarm->id;
        $bericht->save();
        return redirect()->route("bericht.show",$bericht);
    }
}
