<?php

use App\FitCarver;
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
    //return view('welcome');

    // $carver = new FitCarver('usb001.dd');
    $carver = new FitCarver('garmin001.dd');
    $carver->carve();
});
