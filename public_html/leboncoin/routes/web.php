<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeBonCoinController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CityController;

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
});
Route::get("/annonces",[LeBonCoinController::class, "index" ]);

Route::get("/annonce/{id}",[LeBonCoinController::class, "one" ]);

Route::get("/annonce/add",[ LeBonCoinController::class, "add" ]);

Route::post("/annonce/save", [ LeBonCoinController::class, "save"]);

Route::get("/connect", [ LeBonCoinController::class, "connect"]);

Route::get("/createaccount",[ LeBonCoinController::class, "createaccount" ]);

Route::get("/createaccountparticulier", [ LeBonCoinController::class, "createaccountparticulier"]);

Route::get("/search", [ LeBonCoinController::class, "search"]);

Route::post('/search', [SearchController::class, 'search'])->name('search');

Route::get('/search', [CityController::class, 'search']);

Route::post('/process-city', [CityController::class, 'processCity'])->name('process.city');


