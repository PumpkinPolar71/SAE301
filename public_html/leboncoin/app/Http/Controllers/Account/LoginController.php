<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Events\UserLoggedIn;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Compte;
use App\Models\Historisation;

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
            // Authentification réussie
    
            // Récupère l'ID du compte de l'utilisateur
            $idCompte = Auth::user()->idcompte;
    
            // Enregistre la dernière connexion dans la table 'historisation'
            Historisation::updateOrInsert(
                ['idcompte' => $idCompte],
                ['datelogin' => now()]
            );

            // Émet l'événement UserLoggedIn
            event(new UserLoggedIn(Auth::user()));

            $request->session()->regenerate();
            return redirect()->intended('/annonce-filtres?ville=&type_hebergement=&datedebut=');
        }

        return back()->withErrors([
            'email' => 'Mauvais identifiant ou mot de passe.',
        ]);
    }
}