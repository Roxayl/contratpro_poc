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

// Home
Route::get('/', function () {
    return redirect()->route('cerfa.form');
});
Route::get('/laravel', function () {
    return view('welcome');
});

// Formulaire
Route::get('cerfa/form', 'App\Http\Controllers\CerfaController@form')->name('cerfa.form');
Route::match(['get', 'post'], 'cerfa/generate-pdf', 'App\Http\Controllers\CerfaController@generate')->name('cerfa.generate-pdf');

// Import
Route::get('cerfa/import', 'App\Http\Controllers\ImportController@form')->name('cerfa.import-form');
Route::post('cerfa/import', 'App\Http\Controllers\ImportController@import')->name('cerfa.import');

// Export
Route::get('export/json', 'App\Http\Controllers\ExportController@generateJson');
Route::get('export/many-json/{occurrences?}', 'App\Http\Controllers\ExportController@generateManyJson')->name('export.many-json');
Route::get('export/csv', 'App\Http\Controllers\ExportController@generateCsv');
Route::get('export/many-csv/{occurrences?}', 'App\Http\Controllers\ExportController@generateManyCsv')->name('export.many-csv');
