<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeBonCoinController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CityController;
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

Route::post("/annonceeuh",[ LeBonCoinController::class, "add" ]);

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

Route::get("/search", [ LeBonCoinController::class, "search"]);

Route::post('/search', [SearchController::class, 'search'])->name('search');

Route::get('/search', [CityController::class, 'indexe']);

Route::get('/annonce-filtres', [CityController::class, 'indexe'])->name('annonce-index');

Route::get('/adresse/{q}', [CityController::class, 'adresse']);

Route::get("/imgGP",[LeBonCoinController::class, "imgGP" ]);

Route::get("/login",[LoginController::class, "authenticate" ]);

Route::get("/proprio/{id}",[LeBonCoinController::class, "proprio" ]);

Route::get("/compte",[LeBonCoinController::class, "compte" ]);

Route::post('/resolution_incident/{idincident}', 'LeBonCoinController@marquerCommeResolu')->name('resolution_incident');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=');
})->name('logout');

Route::post('/update-user-info', [LeBonCoinController::class, 'updateUserInfo'])->name('updateUserInfo');

Route::get("/reservationlist/{id}",[LeBonCoinController::class, "oneres" ]);

Route::get("/annoncelist/{id}",[LeBonCoinController::class, "oneann" ]);

Route::get("/reservation/{id}",[LeBonCoinController::class, "reservation" ]);

Route::get('/incidents', [LeBonCoinController::class, 'indexIncident']);

Route::get('/resolution/{id}', [LeBonCoinController::class, 'resolution']);

Route::post('/classement-sans-suite/{id}', [LeBonCoinController::class, 'classementSansSuite']);

Route::get('/serviceimmobilier', [ServiceController::class, 'serviceimmobilier']);//get

Route::post('/serviceimmoilier/validatesrv', [ServiceController::class, 'validatesrv']);

Route::post("/annonceserv/{id}",[LeBonCoinController::class, "one" ])->name('annonceserv');

Route::get('/upload', [UploadController::class, 'showForm']);

Route::post('/compte', [UploadController::class, 'upload'])->name('upload');
