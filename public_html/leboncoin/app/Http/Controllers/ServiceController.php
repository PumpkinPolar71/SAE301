<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\LeBonCoin;

class ServiceController extends Controller
{
    public function serviceimmobilier() {
        return view ("serviceimmobilier", ['annonces'=>LeBonCoin::all() ], ['photos'=>Photo::all() ]);
    }
    public function validate(Request $request) {
        if ($request->input("annval") == "oui") {
            return redirect('serviceimmobilier')->withInput()->with("error","La validation n'a pas fonctionné");
        } else {
            if ($request->input("annval") == "oui") {

            } elseif ($request->input("annval") == "non") {

            } else {

            }
        }
    }
}
