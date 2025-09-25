<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\SeksiController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\InstrukturController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

//Crud Dashboard
Route::get('/adm/dashboard', [DashboardController::class, 'view']);


//Crud Seksi/Bidang
Route::get('/adm/seksi', [SeksiController::class, 'view']);
Route::post('/adm/seksi/store', [SeksiController::class, 'store']);
Route::post('/adm/seksi/edit', [SeksiController::class, 'edit']);
Route::post('/adm/seksi/update', [SeksiController::class, 'update']);
Route::post('/adm/seksi/stat', [SeksiController::class, 'stat']);
Route::post('/adm/seksi/status', [SeksiController::class, 'status']);
Route::post('/adm/seksi/hapus', [SeksiController::class, 'hapus']);
Route::post('/adm/seksi/delete', [SeksiController::class, 'delete']);

//Crud Kab / Kota
Route::get('/adm/kota', [KotaController::class, 'view']);
Route::post('/adm/kota/store', [KotaController::class, 'store']);
Route::post('/adm/kota/edit', [KotaController::class, 'edit']);
Route::post('/adm/kota/update', [KotaController::class, 'update']);
Route::post('/adm/kota/stat', [KotaController::class, 'stat']);
Route::post('/adm/kota/status', [KotaController::class, 'status']);
Route::post('/adm/kota/hapus', [KotaController::class, 'hapus']);
Route::post('/adm/kota/delete', [KotaController::class, 'delete']);

//Crud Seksi/Bidang
Route::get('/adm/skpd', [SkpdController::class, 'view']);
Route::post('/adm/skpd/store', [SkpdController::class, 'store']);
Route::post('/adm/skpd/edit', [SkpdController::class, 'edit']);
Route::post('/adm/skpd/update', [SkpdController::class, 'update']);
Route::post('/adm/skpd/stat', [SkpdController::class, 'stat']);
Route::post('/adm/skpd/status', [SkpdController::class, 'status']);
Route::post('/adm/skpd/hapus', [SkpdController::class, 'hapus']);
Route::post('/adm/skpd/delete', [SkpdController::class, 'delete']);

//Crud Instruktur
Route::get('/adm/instruktur', [InstrukturController::class, 'view']);
Route::get('/adm/instruktur/profile/{id_instruktur}', [InstrukturController::class, 'profile']);
Route::post('/adm/instruktur/store', [InstrukturController::class, 'store']);
Route::post('/adm/instruktur/edit', [InstrukturController::class, 'edit']);
Route::post('/adm/instruktur/update', [InstrukturController::class, 'update']);
Route::post('/adm/instruktur/stat', [InstrukturController::class, 'stat']);
Route::post('/adm/instruktur/status', [InstrukturController::class, 'status']);
Route::post('/adm/instruktur/hapus', [InstrukturController::class, 'hapus']);
Route::post('/adm/instruktur/delete', [InstrukturController::class, 'delete']);
