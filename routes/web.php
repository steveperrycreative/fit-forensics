<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\InvestigationController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/investigations', [InvestigationController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/investigations/create', [InvestigationController::class, 'create']);
Route::middleware(['auth:sanctum', 'verified'])->get('/investigations/{investigation}', [InvestigationController::class, 'show']);
Route::middleware(['auth:sanctum', 'verified'])->get('/investigations/{investigation}/search', [InvestigationController::class, 'search']);
Route::middleware(['auth:sanctum', 'verified'])->get('/investigations/{investigation}/carve', [InvestigationController::class, 'carve']);
Route::middleware(['auth:sanctum', 'verified'])->get('/investigations/{investigation}/parse/{file?}', [InvestigationController::class, 'parse']);

Route::middleware(['auth:sanctum', 'verified'])->get('/files/{file}', [FileController::class, 'show']);
Route::middleware(['auth:sanctum', 'verified'])->get('/files/{file}/download', [FileController::class, 'download']);
