<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leboncoin;

class leboncoinController extends Controller
{
    public function index() {
        return view ("annonces-list", ['annonces'=>leboncoin::all() ]);
    }

    public function one($id) {
        return view ("annonce", ['annonce'=>leboncoin::find($id) ]);
    }



    public function add() {
        return view("annonce-add");
    }


  public function save(Request $request)
    {

      if (
          $request->input("name") == "" || 
          $request->input("descr") == "" ||
          $request->input("category") == "" 
         )  {
        return redirect('annonce/add')->withInput()->with("error","Oups, t'as fait une boulette !");

      } else {
        $b = new leboncoin();
        $b->name = $request->input("name");
        $b->descr = $request->input("descr");
        $b->category = $request->input("category");
        $b->save();

        return redirect('annonce/add');
      
      } 
    }


}
