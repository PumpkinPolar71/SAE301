<?php

namespace App\Http\Controllers\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DroitController extends Controller
{
    public function cookie() {
        return view("cookie");
    }
    public function politique() {
        return view("politique");
    }
    public function registre() {
        return view("registre");
    }
    public function contrat() {
        return view("contrat");
    }
}
