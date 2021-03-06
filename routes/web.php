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

// Contrat
Route::get('contrat/form', 'App\Http\Controllers\ContratProController@fill');
Route::get('contrat/create', 'App\Http\Controllers\ContratProController@create');

// Constat achat (exemple)
Route::get('declaration-achat/example', 'App\Http\Controllers\DeclarationAchatController@example');
