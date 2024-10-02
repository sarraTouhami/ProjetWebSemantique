<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DonController;

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

Route::resource('Dons', DonController::class);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hi', function () {

    return view('hi');
});
Route::get('/test', function () {

    return view('test');
});
