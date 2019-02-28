<?php

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

Route::get('/', 'Controller@index');
Route::get('/import-view', 'Controller@importView');
Route::post('/import','ExcelController@import');
Route::get('/export','ExcelController@export');
Route::get('/upload-view','Controller@uploadView');
Route::post('/send-file','EmailController@send');
