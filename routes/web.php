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
        'equipments' => 'EquipmentController',
        'works' => 'WorkController',
        'sheets' => 'SheetController',
        'details' => 'DetailController',
    ]);

    Route::get('sheets/{dv}/export', 'SheetController@export')->name('export');
    Route::post('sheets/{dv}/attach', 'SheetController@attach')->name('sheets.attach');
    Route::delete('sheets/{dv}/attach/{file}/remove', 'SheetController@removeFile')->name('sheets.attach.remove');

    Route::get('summaries', 'SummaryController')->name('summaries');
});

