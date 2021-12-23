<?php

namespace App\Http\Controllers\Uebung;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUebungRequest;
use App\Models\Alarm;

class UebungController extends Controller
{
    public function create()
    {
        return view("uebung.create");
    }

    public function store(CreateUebungRequest $request) {
        $alarm = new Alarm();
        $alarm->is_uebung = 1;
        $alarm->bemerkung = $request->get("thema");
        $alarm->save();
        return redirect()->route("berichte");
    }
}
