<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bericht;

class AdminBerichtController extends Controller
{
    public function index()
    {
        $berichte = Bericht::orderBy('created_at','DESC')->get();
        return view("admin.berichte.index",[
            'berichte' => $berichte,
        ]);
    }

    public function show(Bericht $bericht) {
        return view("admin.berichte.show",[
            'bericht' => $bericht,
        ]);
    }
}
