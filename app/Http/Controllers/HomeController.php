<?php

namespace App\Http\Controllers;

use App\Models\Personal;

class HomeController extends Controller
{
    public function index()
    {
        return view("home.index");
    }

    public function personal() {
        $personal = Personal::orderBy('lastname')->get();
        return view("home.personal",compact('personal'));
    }

    public function download() {
        $personal = Personal::orderBy('lastname')->get();
        $pdf = \PDF::loadView('home.print', compact('personal'));
        return $pdf->download();
    }
}
