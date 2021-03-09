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
Route::get('cerfa/form', 'App\Http\Controllers\CerfaController@form');
Route::match(['get', 'post'], 'cerfa/generate-pdf', 'App\Http\Controllers\CerfaController@generate')->name('cerfa.generate-pdf');

// Import
Route::get('cerfa/import', 'App\Http\Controllers\ImportController@form');
Route::post('cerfa/import', 'App\Http\Controllers\ImportController@import')->name('cerfa.import');

// Export
Route::get('export/json', 'App\Http\Controllers\ExportController@generateJson');
Route::get('export/many-json/{occurrences?}', 'App\Http\Controllers\ExportController@generateManyJson');
Route::get('export/csv', 'App\Http\Controllers\ExportController@generateCsv');
Route::get('export/many-csv/{occurrences?}', 'App\Http\Controllers\ExportController@generateManyCsv');

// Declaration achat (exemple)
Route::get('declaration-achat/example', 'App\Http\Controllers\DeclarationAchatController@example');
