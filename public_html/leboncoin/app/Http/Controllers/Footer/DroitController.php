<?php

namespace App\Http\Controllers\Footer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DroitController extends Controller
{
    public function cookie() {
        return view("Footer/Legislation/cookie");           #FooterFolder #LegislationFolder
    }
    public function politique() {
        return view("Footer/Legislation/politique");        #FooterFolder #LegislationFolder
    }
    public function registre() {
        return view("Footer/Legislation/registre");         #FooterFolder #LegislationFolder
    }
    public function contrat() {
        return view("Footer/Legislation/contrat");          #FooterFolder #LegislationFolder
    }
}
