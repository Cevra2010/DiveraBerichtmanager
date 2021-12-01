<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PersonalController extends Controller
{
    /**
     * Gibt eine View zurück
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view("admin.personal.index");
    }
}
