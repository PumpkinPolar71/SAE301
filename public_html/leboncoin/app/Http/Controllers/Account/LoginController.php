<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\User;

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
        DB::enableQueryLog();

        $credentials = $request->validate([
            'email' => ['required'],
            'motdepasse' => ['required'],
        ]);

        unset($credentials["motdepasse"]);
        $credentials["password"] = $request->motdepasse;


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $queries = DB::getQueryLog();
            Log::info($queries);
            return redirect()->intended('/annonce-filtres?ville=&type_hebergement=&datedebut=');
            
        }

        return back()->withErrors([
            'email' => 'Mauvais identifiant ou mot de passe.',
        ]);
    }
//     public function retrieveUser()
//     {
//         $user = User::select('idcompte', 'idville', 'motdepasse', 'adresseruecompte', 'adressecpcompte', 'codeetatcompte', 'email', 'siret', 'pseudo', 'pdp', 'remember_token', 'lastlogin')
//             ->where('email', 'john.smith@gmail.com')
//             ->first();

//         // Vous pouvez maintenant utiliser l'utilisateur récupéré
//         return view('some.view', ['user' => $user]);
//     }
}