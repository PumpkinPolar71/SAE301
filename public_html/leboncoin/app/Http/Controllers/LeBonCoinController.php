<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeBonCoin;

class LeBonCoinController extends Controller
{
    public function index() {
        return view ("annonces-list", ['annonces'=>LeBonCoin::all() ]);
    }
    public function add() {
        return view("annonce-add");
    }
    public function connect() {
      return view("connect");
    }
    public function createaccount() {
      return view("createaccount");
    }
    public function one($id) {
      return view ("annonce", ['annonce'=>LeBonCoin::find($id) ]);
    }
    public function search() {
      return view("search");
    }
    public function createaccountparticulier() {
      return view("createaccountparticulier"); 
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
        $b = new LeBonCoin();
        $b->name = $request->input("name");
        $b->descr = $request->input("descr");
        $b->category = $request->input("category");
        $b->save();

        return redirect('annonce/add');
      
      } 
    }
}
