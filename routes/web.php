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
    // $carver = new FitCarver('usb001.dd');
    $carver = new FitCarver('experiment-one-usb.dd');
    // $carver = new FitCarver('garmin001.dd');
    $carver->carve();

    // $investigation = Investigation::find(1);
    // $file = $investigation->files()->find(22);
    // $filename = $file->name;

    // $path = storage_path('app/' . $investigation->id . '/' . $filename);
    // $pFFA = new adriangibbons\phpFITFileAnalysis($path);

    // echo 'Output from file: ' . $filename . '<br>';
    // echo 'Original content hash: ' . $file->hash . '<br>';
    // echo 'File hash: ' . hash('sha256', Storage::get($investigation->id . '/' . $filename)) . '<br>';

    // var_dump($pFFA->data_mesgs);

    // dashboard
    // cases
    // files
});

Auth::routes();

Route::get('/', 'InvestigationController@index');
Route::get('/investigation/{investigation}', 'InvestigationController@show');

Route::get('/file/{file}', 'FileController@show');
