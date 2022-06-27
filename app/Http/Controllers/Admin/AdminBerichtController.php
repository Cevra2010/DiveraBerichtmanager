<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bericht;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use Zis\Ext\SettingsManager\Setting;

class AdminBerichtController extends Controller
{
    public function index()
    {
        $autodelete = Setting::get('bericht_autodelete');
        $berichte = Bericht::orderBy('created_at', 'DESC')->get();
        return view("admin.berichte.index", [
            'berichte' => $berichte,
            'autodelete' => $autodelete,
        ]);
    }
    public function uebung()
    {
        $berichte = Bericht::orderBy('created_at','DESC')->get();
        return view("admin.berichte.uebung",[
            'berichte' => $berichte,
        ]);
    }

    public function show(Bericht $bericht) {
        return view("admin.berichte.show",[
            'bericht' => $bericht,
        ]);
    }

    public function einsatzbestaetigung($bericht = null) {
        return view("admin.berichte.bestaetigung",[
            'bericht' => $bericht,
        ]);
    }

    public function uebungStatistik() {
        return view("admin.berichte.uebung-statistik");
    }

    public function generateBestaetigung() {
        if (!$logo = Setting::get('logo')) {
            $logo = null;
        } else {
            $logo = Setting::get('logo');
            $logo = Storage::path($logo);
        }

        $pdf = \PDF::loadView('pdf.teilnahme',[
            'logo' => $logo,
            'name' => session()->get('name'),
            'alarm_at' => session()->get('alarm_at'),
            'alarm_end_at' => session()->get('alarm_end_at'),
            'einsatznummer' => session()->get('einsatznummer'),
            'adressat' => session()->get('adressat'),
        ]);

        return $pdf->download();
    }
}
