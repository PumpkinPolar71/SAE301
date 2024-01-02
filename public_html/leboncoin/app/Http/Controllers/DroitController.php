<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DroitController extends Controller
{
    public function cookie() {
        return view("cookie");
    }
    public function politique() {
        return view("politique");
    }
}
