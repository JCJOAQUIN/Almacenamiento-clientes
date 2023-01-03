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
    return view('customers/create');
});
Route::prefix('clients/')->name('clients.')->group(function()
{
    Route::get('search','App\Http\Controllers\clientsConfigurationController@search')->name('search');
    Route::get('search/{id}/delete','App\Http\Controllers\clientsConfigurationController@suspend')->name('suspend');
});
Route::resource('clients','App\Http\Controllers\clientsConfigurationController');
