<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PersonalController extends Controller
{
    public function index()
    {
        return view("admin.personal.index");
    }
}
