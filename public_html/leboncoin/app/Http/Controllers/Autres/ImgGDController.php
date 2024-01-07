<?php

namespace App\Http\Controllers\Autres;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


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
