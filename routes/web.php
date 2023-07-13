<?php

use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\JenisController;
use App\Http\Controllers\CMS\ProfilController;
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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/jenis', [JenisController::class, 'index']);
Route::get('/profile', [ProfilController::class, 'index']);
