<?php

namespace App\Http\Controllers\Autres;

use Illuminate\Http\Request;
use App\Models\LeBonCoin;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index() {
        return view("welcome",
            [ "todays" => LeBonCoin::inRandomOrder()->first() ]
        );
    }
}
