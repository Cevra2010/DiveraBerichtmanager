<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewBerichtRequest;
use App\Models\Alarm;
use App\Models\Bericht;
use Carbon\Carbon;

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
    public function create(Alarm $alarm)
    {
        if ($alarm->bericht) {
            return redirect()->route("bericht.show", $alarm->bericht);
        }

        $bericht = new Bericht();
        if ($alarm->alarm_at){
            $bericht->start_at = $alarm->alarm_at;
        }
        else {
            $bericht->start_at = Carbon::now();
        }
        $bericht->alarm_id = $alarm->id;
        $bericht->save();
        return redirect()->route("bericht.show",$bericht);
    }

    public function new() {
        return view("bericht.new");
    }

    public function storeNew(StoreNewBerichtRequest $request) {
        $alarm = new Alarm();
        $alarm->einsatz_nr = $request->get('einsatz_nr');
        $alarm->stichwort = $request->get("stichwort");
        $alarm->bemerkung = $request->get("bemerkung");
        $alarm->address = $request->get("address");
        $alarm->save();

        return redirect()->route("berichte");
    }
}
