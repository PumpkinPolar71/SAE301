<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeBonCoinController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Response;

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

Route::get("/annonce/{id}",[LeBonCoinController::class, "one" ]); //la

Route::get("/annonceeuh",[ LeBonCoinController::class, "add" ]);

Route::post('/process-form', [LeBonCoinController::class, 'processForm'])->name('process-form');

Route::post("/annonce/save", [ LeBonCoinController::class, "save"]);

Route::post("/annonce/saveent", [ LeBonCoinController::class, "saveent"]);

Route::get("/connect", [ LeBonCoinController::class, "connect"]);

Route::get("/createaccount",[ LeBonCoinController::class, "createaccount" ]);

Route::post('/update-user-info', 'LeBonCoinController@updateUserInfo')->name('updateUserInfo');

Route::get("/createaccountparticulier", [ LeBonCoinController::class, "createaccountparticulier"]);

Route::get("/createaccountentreprise", [ LeBonCoinController::class, "createaccountentreprise"]);



Route::get("/search", [ LeBonCoinController::class, "search"]);
Route::post('/search', [SearchController::class, 'search'])->name('search');

Route::get('/search', [CityController::class, 'indexe']);
Route::get('/annonce-filtres', [CityController::class, 'indexe'])->name('annonce-index');
Route::get('/adresse/{q}', [CityController::class, 'adresse']);
Route::get("/imgGP",[LeBonCoinController::class, "imgGP" ]);

Route::get("/login",[LoginController::class, "authenticate" ]);

Route::get("/proprio/{id}",[LeBonCoinController::class, "proprio" ]);

Route::get("/compte",[LeBonCoinController::class, "compte" ]);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/annonce-filtres?ville=&type_hebergement=&datedebut=');
})->name('logout');

Route::post('/update-user-info', [LeBonCoinController::class, 'updateUserInfo'])->name('updateUserInfo');

Route::get("/reservationlist/{id}",[LeBonCoinController::class, "oneres" ]);

Route::get("/reservation/{id}",[LeBonCoinController::class, "reservation" ]);
