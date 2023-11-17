<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeBonCoin;

class SiteController extends Controller
{
    public function index() {
        return view("welcome",
            [ "todays" => LeBonCoin::inRandomOrder()->first() ]

        );
    }
}
