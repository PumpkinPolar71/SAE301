<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeBonCoinController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FiltreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GeocodeController;
use App\Http\Controllers\CreateAccount;
use App\Http\Controllers\EncryptionController;
use Illuminate\Http\Response;
use App\Http\Controllers\UploadController;

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\InfosBancairesController;
use App\Http\Controllers\LocalisationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    redirect('/annonces');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mes-incidents', [IncidentController::class, 'mesIncidents'])->name('mes-incidents');
    Route::post('/reconnaissance-justifie/{id}', [LeBonCoinController::class, 'reconnaissanceJustifie'])->name('reconnaissance-justifie');
    Route::get('/mes-recherches', [RechercheController::class, 'mesRecherches'])->name('mes-recherches');
});



//_______________________________________________.ANNONCE_CONTROLLER.___________________________________________________//
    //------------------------------------Afficher_les_annonces-------------------------------------//
        Route::get("/annonces",[LeBonCoinController::class, "index" ]); //sert a rien non ?

    //------------------------------------?-------------------------------------//
        Route::get("/annonce/{id}",[AnnonceController::class, "one" ]);
        Route::post("/annonce/{id}",[AnnonceController::class, "one" ]);

    //------------------------------------Créer_une_nouvelle_annonce-------------------------------------//
        Route::get("/createAnnonce",[ AnnonceController::class, "add" ]);
        Route::post("/ajouterAnnonce",[ AnnonceController::class, "ajouterAnnonce" ]);

//


//_______________________________________________.INCIDENT_CONTROLLER.___________________________________________________//
    //--------------------------------------Sauvegarder_un_incident------------------------------//
        Route::post('/annonce/incidentsave', [IncidentController::class, 'incidentsave']);

    //--------------------------------------?_incident------------------------------//
        Route::get('/incident', [IncidentController::class, 'indexIncident']);

    //--------------------------------------Classer_un_incident_sans_suite------------------------------//
        Route::post('/classement-sans-suite/{id}', [IncidentController::class, 'classementSansSuite']);

    //--------------------------------------Marquer_un_incident_comme_résolu------------------------------//
        // Route::post('/resolution_incident/{idincident}', [IncidentController::class, 'marquerCommeResolu'])->name('resolution_incident');
        // Route::post('/resolution_incident/{idincident}', [LeBonCoinController::class, "marquerCommeResolu"]);

    //--------------------------------------?_un_incident------------------------------//
        // Route::get('/incidents', [LeBonCoinController::class,'indexIncidentprop'])->name('incidents.index');
//


//_______________________________________________.USER_CONTROLLER.___________________________________________________//
    //--------------------------------------Modifier_son_compte------------------------------//
        Route::post('/update-user-info', [UserController::class, 'updateUserInfo'])->name('updateUserInfo');
    //--------------------------------------Créer_un_compte_particulier------------------------------//
        Route::get("/createaccountparticulier", [ UserController::class, "createaccountparticulier"]);
    //--------------------------------------Créer_un_compte_particulier------------------------------//
        Route::get("/createaccountentreprise", [ UserController::class, "createaccountentreprise"]);

//


//_______________________________________________.RECHERCHE_CONTROLLER.___________________________________________________//
    //--------------------------------------Recherche_par_filtres------------------------------//
        Route::get('/annonce-filtres', [RechercheController::class, 'indexe'])->name('annonce-index');
    //--------------------------------------Voir_mes_recherches------------------------------//
        Route::get('/mes_recherches', [RechercheController::class, 'mes_recherches']);
    //--------------------------------------Barre_de_recherche------------------------------//
        Route::get("/search", [RechercheController::class, "search"]);
    //--------------------------------------Recherches------------------------------//
        Route::post('/search', [RechercheController::class, 'search'])->name('search');

        Route::get('/search', [RechercheController::class, 'indexe']);
//


Route::get('/serviceimmobilier', [ServiceController::class, 'serviceimmobilier']);

//Route::post('/serviceimmoilier/validateann', [ServiceController::class, 'validateann']);

//Route::post("/annonce/{id}",[ServiceController::class, "validateann" ]);


Route::post("oneann",[ServiceController::class, "oneann" ])->name("oneann");


Route::post('/process-form', [LeBonCoinController::class, 'processForm'])->name('process-form');

Route::post("/annonce/save", [ CreateAccount::class, "save"]);

Route::post("/saveent", [ CreateAccount::class, "saveent"])->name('saveent');

Route::get("/connect", [ LeBonCoinController::class, "connect"])->name('connect');

Route::get("/createaccount",[ LeBonCoinController::class, "createaccount" ]);

Route::get('/adresse/{q}', [FiltreController::class, 'adresse']);

Route::get("/imgGP",[LeBonCoinController::class, "imgGP" ]);

Route::get("/login",[LoginController::class, "authenticate" ]);

Route::get("/proprio/{id}",[LeBonCoinController::class, "proprio" ]);

Route::get("/compte",[LeBonCoinController::class, "compte" ]);

Route::post('/annonce/deposerAvis', [LeBonCoinController::class, 'deposerAvis']);


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=');
})->name('logout');



Route::get("/reservationlist/{id}",[LeBonCoinController::class, "oneres" ]);

Route::get("/annoncelist/{id}",[LeBonCoinController::class, "oneann" ]);

Route::get("/reservation/{id}",[LeBonCoinController::class, "reservation" ]);


Route::get('/enregistrer_avis', [LeBonCoinController::class, 'gestionAvis']);

Route::get('/resolution/{id}', [LeBonCoinController::class, 'resolution']);

Route::post('/modifierAvis/{id}', [LeBonCoinController::class, 'modifierAvis']);


Route::post("/annonceserv/{id}",[LeBonCoinController::class, "one" ])->name('annonceserv');

Route::get('/upload', [UploadController::class, 'showForm']);

// Route::post('/compte', [UploadController::class, 'upload'])->name('upload');

Route::get('/favoris/{id}', [LeBonCoinController::class, 'favoris']);

Route::get('/guide', [LeBonCoinController::class, 'guide']);

Route::get('/sauvefavoris/{id}', [LeBonCoinController::class, 'sauvefavoris']);

Route::get('/supprfavoris/{id}', [LeBonCoinController::class, 'supprfavoris']);

Route::get('/redirection', [LeBonCoinController::class, 'redirection'])->name('redirection');



Route::get('/createheb', [ServiceController::class, 'createheb'])->name('createheb');

Route::post('/createheb', [ServiceController::class, 'ajoutequ'])->name('ajoutequ');

//Route::post('/createheb', [ServiceController::class, 'createheb'])->name('createheb');


Route::get('/annonces-non-validees', [LeBonCoinController::class, 'annoncesNonValidees'])->name('annonces.non-validees');

Route::post('/valider-annonce/{idannonce}', [LeBonCoinController::class, 'validerAnnonce'])->name('validerAnnonce');



//Route::post('/changer-statut/{id}', [LeBonCoinController::class, 'changer-statut']);

Route::post('/ajoutheb', [ServiceController::class, 'ajoutheb'])->name('ajoutheb');

Route::post('/sauvrecherche', [SearchController::class, 'sauvrecherche'])->name('sauvrecherche');
// Route::match(['get', 'post'], '/get-annonces', [FiltreController::class, 'getAnnonces'])->name('get-annonces');

// web.php

Route::get('/inscription-attente', [LeBonCoinController::class, 'afficherInscriptionAttente']);


// -------------------------------------------------------------------Carte-----------------------------//
Route::get('/geocode/{city}', 'GeocodeController@geocode');

Route::get('/carte', [FiltreController::class, 'carteFiltre'])->name('annonce-carte');

Route::match(['get', 'post'], '/get-annonces', [FiltreController::class, 'getAnnonces'])->name('get-annonces');

//-----------------------------------------------INFOS BANCAIRES-------------------------------------------//
Route::get('/mes-infos-bancaires', [LeBonCoinController::class, 'cryptInfosBc'])->name('mes-infos-bancaires');

Route::post('/mes-infos-bancaires', [EncryptionController::class, 'encrypt'])->name('encrypt');

//---------------------------------------------------------

Route::get('/newreservation', [LeBonCoinController::class, 'newres']);
// Route pour enregistrer la nouvelle réservation
Route::post('/addreservation/{id}', [LeBonCoinController::class, 'ajouterReservation'])->name('addreservation');

Route::post('/payement/{id}', [LeBonCoinController::class, 'payement'])->name('payement');
Route::get('/payement/{idannonce}', [LeBonCoinController::class,'showPayementForm'])->name('payement');

Route::get('/newreservation/{idannonce}', [LeBonCoinController::class, 'showReservationForm'])->name('showreservationform');



Route::get('/mes_messages', [LeBonCoinController::class, 'mes_messages']);

