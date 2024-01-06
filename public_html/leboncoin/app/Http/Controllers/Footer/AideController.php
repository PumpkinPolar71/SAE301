<?php

namespace App\Http\Controllers\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AideController extends Controller
{
    public function aide() {
        return view("aide");
    }
    public function aidecompte() {
        return view("aidecompte");
    }
    public function aideannonce() {
        return view("aideannonce");
    }
    public function aideres() {
        return view("aideres");
    }
}
