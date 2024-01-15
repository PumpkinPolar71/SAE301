<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LogUserLastLogin implements ShouldQueue
{
    public function handle(UserLoggedIn $event)
    {
        $user = $event->user;

        // Enregistre la dernière connexion dans la table 'historisation'
        DB::table('historisation')->where('idcompte', $user->id)->update([
            'datelogin' => now(),
        ]);
    }
}
