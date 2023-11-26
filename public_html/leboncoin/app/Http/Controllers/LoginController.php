<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'login' => ['required'],//nom dans la bd
            'motdepasse' => ['required'],
        ]);

        unset($credentials["modepasse"]);
        $credentials["password"] = $request->motdepasse;


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Mauvais identifiant ou mot de passe.',
        ]);
    }
}