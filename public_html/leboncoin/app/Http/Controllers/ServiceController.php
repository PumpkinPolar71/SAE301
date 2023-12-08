<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Photo;
use App\Models\LeBonCoin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Config;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function serviceimmobilier() {
        return view ("serviceimmobilier", ['annonces'=>LeBonCoin::all() ], ['photos'=>Photo::all() ]);
    }
    
    public function validatesrv(Request $request, array $rules, array $messages = [], array $attributes = []) {
        if ($request->input("annval") == "oui") {
            return redirect('serviceimmobilier')->withInput()->with("error","La validation n'a pas fonctionné");
        } else {
            if ($request->input("annval") == "oui") {

            } elseif ($request->input("annval") == "non") {

            } else {

            }
             return redirect('serviceimmobilier')->withInput()->with("error","Validation effectuée");
        }
    }
}
