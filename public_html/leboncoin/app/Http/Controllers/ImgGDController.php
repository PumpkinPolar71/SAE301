<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImgGDController extends Controller
{
    public function imgGP() 
    {
        return view("imgGP");
    }

    public function showForm()
    {
        return view('compte');
    }
}
