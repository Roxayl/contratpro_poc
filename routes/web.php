<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Cerfa
Route::get('cerfa/test', 'App\Http\Controllers\CerfaController@poc');

// Contrat
Route::get('contrat/form', 'App\Http\Controllers\ContratProController@fill');
Route::get('contrat/create-example', 'App\Http\Controllers\ContratProController@createFromDummyData')
    ->name('contrat.create-dummy');
Route::post('contrat/create', 'App\Http\Controllers\ContratProController@createFromRequest')
    ->name('contrat.create');

// Declaration achat (exemple)
Route::get('declaration-achat/example', 'App\Http\Controllers\DeclarationAchatController@example');
