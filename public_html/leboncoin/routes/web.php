<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeBonCoinController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FiltreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Response;
use App\Http\Controllers\UploadController;

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
Route::get("/annonces",[LeBonCoinController::class, "index" ]);

Route::get("/annonce/{id}",[LeBonCoinController::class, "one" ]);

Route::post("/annonce/{id}",[ServiceController::class, "one" ]);

//Route::get('/serviceimmobilier', [ServiceController::class, 'serviceimmobilier']);

//Route::post('/serviceimmoilier/validateann', [ServiceController::class, 'validateann']);

//Route::post("/annonce/{id}",[ServiceController::class, "validateann" ]);

Route::get("/annonceeuh",[ LeBonCoinController::class, "add" ]);

Route::post("/annonce/ajouterAnnonce",[ LeBonCoinController::class, "ajouterAnnonce" ]);

Route::post('/process-form', [LeBonCoinController::class, 'processForm'])->name('process-form');

Route::post("/annonce/save", [ LeBonCoinController::class, "save"]);

Route::post("/annonce/saveent", [ LeBonCoinController::class, "saveent"]);

Route::get("/connect", [ LeBonCoinController::class, "connect"]);

Route::get("/createaccount",[ LeBonCoinController::class, "createaccount" ]);

Route::post('/update-user-info', 'LeBonCoinController@updateUserInfo')->name('updateUserInfo');

Route::get("/createaccountparticulier", [ LeBonCoinController::class, "createaccountparticulier"]);

//Route::get('/annonce/incidentsave/{id}', [LeBonCoinController::class, 'show']);

Route::get("/createaccountentreprise", [ LeBonCoinController::class, "createaccountentreprise"]);

Route::post('/annonce/incidentsave', [LeBonCoinController::class, 'incidentsave']);

Route::get("/search", [ LeBonCoinController::class, "search"]); //barre de recherche

Route::post('/search', [SearchController::class, 'search'])->name('search'); //index-annonce

Route::get('/search', [FiltreController::class, 'indexe']);

Route::get('/annonce-filtres', [FiltreController::class, 'indexe'])->name('annonce-index');

Route::get('/adresse/{q}', [FiltreController::class, 'adresse']);

Route::get("/imgGP",[LeBonCoinController::class, "imgGP" ]);

Route::get("/login",[LoginController::class, "authenticate" ]);

Route::get("/proprio/{id}",[LeBonCoinController::class, "proprio" ]);

Route::get("/compte",[LeBonCoinController::class, "compte" ]);

Route::post('/annonce/deposerAvis', [LeBonCoinController::class, 'deposerAvis']);

Route::post('/resolution_incident/{idincident}', 'LeBonCoinController@marquerCommeResolu')->name('resolution_incident');
//Route::post('/resolution_incident/{idincident}', [LeBonCoinController::class, "marquerCommeResolu"]);



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=');
})->name('logout');

Route::post('/update-user-info', [LeBonCoinController::class, 'updateUserInfo'])->name('updateUserInfo');

Route::get("/reservationlist/{id}",[LeBonCoinController::class, "oneres" ]);

Route::get("/annoncelist/{id}",[LeBonCoinController::class, "oneann" ]);

Route::get("/reservation/{id}",[LeBonCoinController::class, "reservation" ]);

Route::get('/incident', [LeBonCoinController::class, 'indexIncident']);

Route::get('/enregistrer_avis', [LeBonCoinController::class, 'gestionAvis']);

Route::get('/resolution/{id}', [LeBonCoinController::class, 'resolution']);

Route::post('/modifierAvis/{id}', [LeBonCoinController::class, 'modifierAvis']);

Route::post('/classement-sans-suite/{id}', [LeBonCoinController::class, 'classementSansSuite']);

Route::post("/annonceserv/{id}",[LeBonCoinController::class, "one" ])->name('annonceserv');

Route::get('/upload', [UploadController::class, 'showForm']);

Route::post('/compte', [UploadController::class, 'upload'])->name('upload');

Route::get('/favoris/{id}', [LeBonCoinController::class, 'favoris']);

Route::get('/sauvefavoris/{id}', [LeBonCoinController::class, 'sauvefavoris']);

Route::get('/supprfavoris/{id}', [LeBonCoinController::class, 'supprfavoris']);

Route::get('/redirection', [LeBonCoinController::class, 'redirection']);

Route::middleware(['auth'])->group(function () {
    Route::get('/mes-incidents', [LeBonCoinController::class, 'mesIncidents'])->name('mes-incidents');
    Route::post('/reconnaissance-justifie/{id}', [LeBonCoinController::class, 'reconnaissanceJustifie'])->name('reconnaissance-justifie');
    Route::get('/mes-recherches', [LeBonCoinController::class, 'mesRecherches'])->name('mes-recherches');
});

Route::get('/createheb', [ServiceController::class, 'createheb'])->name('createheb');

Route::get('/add-reservation', [LeBonCoinController::class, 'ajouterReservation'])->name('add-reservation');



Route::get('/annonces-non-validees', [LeBonCoinController::class, 'annoncesNonValidees'])->name('annonces.non-validees');
Route::post('/valider-annonce/{id}', [LeBonCoinController::class, 'validerAnnonce'])->name('validerAnnonce');

Route::get('/incidents', 'LeBonCoinController@indexIncidentprop')->name('incidents.index');

//Route::post('/changer-statut/{id}', [LeBonCoinController::class, 'changer-statut']);

Route::post('/ajoutheb', [ServiceController::class, 'ajoutheb'])->name('ajoutheb');

Route::get('/geocode/{city}', 'GeocodeController@geocode');
