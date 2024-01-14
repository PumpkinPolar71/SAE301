<?php
namespace App\Http\Controllers;
   
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
   
class BotManController extends Controller
{
    
    public function handle()
    {
        $botman = app('botman');

        $botman->hears("{question}", function ($bot,$question) {
            if ($question == "Je n’arrive pas à charger la page?") {
                $bot->reply("Rechargez la page ou vérifier votre connexion à internet");
            }
            else if ($question == "Je ne trouve pas l’annonce que je recherche") {
                $bot->reply("Etes vous sur que l’annonce existe?si vous l'etes, pour la trouver, utilisez les filtres et/ou la barre de recherche");
            }
            else if ($question == "Je ne peux pas faire de réservation ?") {
                $bot->reply("Etes-vous connectez à votre compte ?si oui il est possible que la réservation soit déjà réservée pour la date demandée ");
            }
            else if ($question == "Y a-t-il un problème avec le système de paiement en ligne ? Ma transaction ne se termine pas.") {
                $bot->reply("Nous n’avons pas de problème de notre côté si le problème persiste contactez votre banque");
            }
            else if ($question == "Je n’arrive pas à trouver l’annonce que je viens de déposer parmis les autres annonces. Pouvez-vous me guider ?") {
                $bot->reply("L’annonce doit être vérifiée avant de pouvoir être visible pour les autres utilisateurs. Vous pouvez la retrouvé dans la section compte dans la rubrique « mes annonces »");
            }
            else if ($question == "Je n’arrive pas à désactiver les cookies, comment faire ?") {
                $bot->reply("Cliquez sur la tarte au citron en bas a droite de la page et vous pourrez gérer vos cookies");
            }
            else if ($question == "J’ai eu un problème lors de ma location, je veux signaler un problème, comment faire?") {
                $bot->reply("Vous pouvez signaler un problème sur l’annonce qui vous a posé problème, il sera reporté aux services incidents pour entamer une procédure entre vous et le propriétaire");
            }
            else if ($question == "Je n’arrive pas à me connecter à mon compte, pouvez vous me guider?") {
                $bot->reply("Vérifiez que votre adresse mail et votre mot de passe soient corrects, vérifiez que la touche Maj et Verr Num soient ou ne soient pas activées. Si le problème persiste contactez nos techniciens à l’adresse suivante : xxxx@xxx.com");
            }
            else if ($question == "Est-ce que je peux sauvegarder ma recherche ?") {
                $bot->reply("Vous pouvez sauvegarder votre recherche grace au bouton présent sur la page en meme temps que vous faites défiler les annonces.");
            }

        });

        $botman->listen();
    }
}

