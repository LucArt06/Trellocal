<?php

/**
 *
 */

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ProfilController;


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

/**
 * Création des différentes routes
 */
Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->name('home.index');

Route::post('/home', [HomeController::class, 'store'])
    ->name('home.store');

Route::get('/board/{id}', [HomeController::class, 'show'])
    ->name('board.show');

Route::put('/home/{id}', [HomeController::class, 'update'])
    ->name('home.update');

Route::delete('/home/{id}', [HomeController::class, 'destroy'])
    ->name('home.destroy');

Route::resource('/profil', ProfilController::class);

Route::resource('/board', ListController::class);

Route::resource('/card', CardController::class);

Route::resource('/comment', CommentController::class);

Route::resource('/autho', AuthorizationController::class);
