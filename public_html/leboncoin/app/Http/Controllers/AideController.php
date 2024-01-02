<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AideController extends Controller
{
    public function aide() {
        return view("aide");
      }
}
