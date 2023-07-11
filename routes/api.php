<?php

use App\Http\Controllers\CMS\HewanController;
use App\Http\Controllers\CMS\JenisController;
use App\Http\Controllers\CMS\ProfilController;
use App\Http\Controllers\CMS\UpdateHargaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1/jenis')->controller(JenisController::class)->group(function()
{
    Route::get   ('/'    , 'getPayloadData' );
    Route::post  ('/'    , 'upsertPayloadData' );
    Route::get   ('/{id}', 'getPayloadDataId');
    Route::delete('/{id}', 'deletePayloadData' );
});

Route::prefix('v1/profile')->controller(ProfilController::class)->group(function()
{
    Route::get   ('/'    , 'getPayloadData' );
    Route::post  ('/'    , 'upsertPayloadData' );
    Route::get   ('/{id}', 'getPayloadDataId');
    Route::delete('/{id}', 'deletePayloadData' );
});

Route::prefix('v1/update_harga')->controller(UpdateHargaController::class)->group(function()
{
    Route::get   ('/'    , 'getPayloadData' );
    Route::post  ('/'    , 'upsertPayloadData' );
    Route::get   ('/{id}', 'getPayloadDataId');
    Route::delete('/{id}', 'deletePayloadData' );
});

Route::prefix('v1/hewan')->controller(HewanController::class)->group(function()
{
    Route::get   ('/'    , 'getPayloadData' );
    Route::post  ('/'    , 'upsertPayloadData' );
    Route::get   ('/{id}', 'getPayloadDataId');
    Route::delete('/{id}', 'deletePayloadData' );
});
