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
Route::get('/extract', '\App\Http\Controllers\FeaturesController@extract')->name('extract');
Route::get('/extract/emotion', '\App\Http\Controllers\EmotionsController@extract_emotion')->name('extract.emotion');
