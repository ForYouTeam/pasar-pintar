<?php

use App\Http\Controllers\CMS\AkunController;
use App\Http\Controllers\CMS\AuthController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\HewanController;
use App\Http\Controllers\CMS\JenisController;
use App\Http\Controllers\CMS\ProfilController;
use App\Http\Controllers\CMS\UpdateHargaController;
use App\Http\Controllers\WEB\IndexController;
use App\Models\UpdateHargaModel;
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

Route::get('/dashboard'             , [DashboardController   ::class, 'index' ])->middleware('auth'                          )->name('dashboard' );
Route::get('/jenis'        , [JenisController       ::class, 'index' ])->middleware('auth', 'role:super-admin|admin')->name('jenis'     );
Route::get('/profile'      , [ProfilController      ::class, 'index' ])->middleware('auth', 'role:super-admin|admin')->name('profile'   );
Route::get('/update_harga' , [UpdateHargaController ::class, 'index' ])->middleware('auth', 'role:super-admin|admin')->name('update'    );
Route::get('/hewan'        , [HewanController       ::class, 'index' ])->middleware('auth', 'role:super-admin|admin')->name('hewan'     );
Route::get('/akun'         , [AkunController        ::class, 'index' ])->middleware('auth', 'role:super-admin'      )->name('akun'      );

Route::get('/'            , [IndexController ::class, 'indexView' ])->name('pasar'    );
Route::get('/pasar/pesan' , [IndexController ::class, 'pesanan'   ])->name('pemesanan');

Route::get('/auth'    , [AuthController ::class, 'index'  ])->name('login'  );
Route::get('/process' , [AuthController ::class, 'login'  ])->name('process');
Route::get('/logout'  , [AuthController ::class, 'logout' ])->name('logout' );
