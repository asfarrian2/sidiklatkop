<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\SeksiController;
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
Route::post('/adm/seksi/hapus', [SeksiController::class, 'hapus']);
Route::post('/adm/seksi/delete', [SeksiController::class, 'delete']);

