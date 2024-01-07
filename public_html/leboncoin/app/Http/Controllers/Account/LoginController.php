<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required'],
            'motdepasse' => ['required'],
        ]);

        unset($credentials["motdepasse"]);
        $credentials["password"] = $request->motdepasse;


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/annonce-filtres?ville=&type_hebergement=&datedebut=');
            
        }

        return back()->withErrors([
            'email' => 'Mauvais identifiant ou mot de passe.',
        ]);
    }
}