<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use PDF;

class HomeController extends Controller
{
    /**
     * Startseite anzeigen
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view("home.index");
    }

    /**
     * Personalliste anzeigen
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function personal() {
        $personal = Personal::orderBy('lastname')->get();
        return view("home.personal",compact('personal'));
    }

    /**
     * PDF erzeugung und Response einer PDF Datei mit aktuellem Personal
     *
     * @return mixed
     */
    public function download() {
        $personal = Personal::orderBy('lastname')->get();
        $pdf = PDF::loadView('home.print', compact('personal'));
        return $pdf->download();
    }
}
