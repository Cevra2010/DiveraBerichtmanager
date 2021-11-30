<?php

namespace App\Http\Controllers;

use App\Models\Alarm;
use App\Models\Bericht;

class BerichtController extends Controller
{
    public function index()
    {
        return view("bericht.index");
    }

    public function show(Bericht $bericht) {
        return view("bericht.show",compact('bericht'));
    }

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
