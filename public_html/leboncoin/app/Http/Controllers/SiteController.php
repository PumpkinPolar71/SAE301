<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leboncoin;

class SiteController extends Controller
{
    public function index() {
        return view("welcome",
            [ "todays" => leboncoin::inRandomOrder()->first() ]

        );
    }
}
