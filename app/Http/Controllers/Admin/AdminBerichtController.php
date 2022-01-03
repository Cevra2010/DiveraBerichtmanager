<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bericht;
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
}
