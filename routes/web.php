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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::resources([
        'sectors' => 'SectorController',
        'cabinets' => 'CabinetController',
        'cameras' => 'CameraController',
    ]);

    Route::get('summaries', 'SummaryController')->name('summaries');
});
