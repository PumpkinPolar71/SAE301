<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Compte;
use App\Models\Carte;
use App\Models\Enregistre;
use Illuminate\Support\Facades\Auth;


class EncryptionController extends Controller
{
    public function encrypt(Request $request)
{
    $comptes = Compte::all();
    $enregistres = Enregistre::all();
    $cartes = Carte::all();

    $key = 'hfhkffhgjkghfhsgjskjidfhfhsdfhsgdhfssdfgsyfkdshfjdhfu';

    return view("infosbancaires", compact('comptes', 'enregistre', 'cartes'));
}}