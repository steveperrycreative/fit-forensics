<?php

use App\FitCarver;
use Illuminate\Support\Facades\Auth;
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

Route::get('/carve', function () {
    $carver = new FitCarver('experiment-one-usb.dd');
//    $carver = new FitCarver('experiment-two-usb.dd');
//    $carver = new FitCarver('experiment-three-garmin.dd');
    $carver->carve();
});

Auth::routes();

Route::get('/', 'InvestigationController@index');

Route::get('/investigation/{investigation}', 'InvestigationController@show');
Route::get('/investigation/{investigation}/parse/{file?}', 'InvestigationController@parse');

Route::get('/file/{file}', 'FileController@show');
