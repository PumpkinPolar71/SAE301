<?php

namespace App\Http\Controllers\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DroitController extends Controller
{
    public function cookie() {
        return view("Footer/Legislation/cookie");
    }
    public function politique() {
        return view("Footer/Legislation/politique");
    }
    public function registre() {
        return view("Footer/Legislation/registre");
    }
    public function contrat() {
        return view("Footer/Legislation/contrat");
    }
}
