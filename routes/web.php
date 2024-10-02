<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\InventaireBeneficiaireController;
use App\Http\Controllers\ProduitAlimentaireController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('posts', PostController::class);
Route::resource('demandes', DemandeController::class);
Route::resource('inventaires-beneficiaires', InventaireBeneficiaireController::class);
Route::resource('reservations', ReservationController::class);
Route::resource('notifications', NotificationController::class);


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/demandes', function () {

//     return view('demandes/index');
// });
Route::get('/hi', function () {

    return view('hi');
});

Route::get('/test', function () {

    return view('test');
});
Route ::resource('produitAlimentaire',ProduitAlimentaireController::class);





