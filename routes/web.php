<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SeksiController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\TahunanggaranController;
use App\Http\Controllers\JkoperasiController;
use App\Http\Controllers\jukmController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KdiklatController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\DiklatController;
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

//Crud Tahun Anggaran
Route::get('/adm/tahunanggaran', [TahunanggaranController::class, 'view']);
Route::post('/adm/tahunanggaran/store', [TahunanggaranController::class, 'store']);
Route::post('/adm/tahunanggaran/edit', [TahunanggaranController::class, 'edit']);
Route::post('/adm/tahunanggaran/update', [TahunanggaranController::class, 'update']);
Route::post('/adm/tahunanggaran/stat', [TahunanggaranController::class, 'stat']);
Route::post('/adm/tahunanggaran/status', [TahunanggaranController::class, 'status']);
Route::post('/adm/tahunanggaran/hapus', [TahunanggaranController::class, 'hapus']);
Route::post('/adm/tahunanggaran/delete', [TahunanggaranController::class, 'delete']);

//Crud Jenis Koperasi
Route::get('/adm/jeniskoperasi', [jkoperasiController::class, 'view']);
Route::post('/adm/jeniskoperasi/store', [jkoperasiController::class, 'store']);
Route::post('/adm/jeniskoperasi/edit', [jkoperasiController::class, 'edit']);
Route::post('/adm/jeniskoperasi/update', [jkoperasiController::class, 'update']);
Route::post('/adm/jeniskoperasi/stat', [jkoperasiController::class, 'stat']);
Route::post('/adm/jeniskoperasi/status', [jkoperasiController::class, 'status']);
Route::post('/adm/jeniskoperasi/hapus', [jkoperasiController::class, 'hapus']);
Route::post('/adm/jeniskoperasi/delete', [jkoperasiController::class, 'delete']);

//Crud Sektor Usaha UMKM
Route::get('/adm/sektorusaha', [jukmController::class, 'view']);
Route::post('/adm/sektorusaha/store', [jukmController::class, 'store']);
Route::post('/adm/sektorusaha/edit', [jukmController::class, 'edit']);
Route::post('/adm/sektorusaha/update', [jukmController::class, 'update']);
Route::post('/adm/sektorusaha/stat', [jukmController::class, 'stat']);
Route::post('/adm/sektorusaha/status', [jukmController::class, 'status']);
Route::post('/adm/sektorusaha/hapus', [jukmController::class, 'hapus']);
Route::post('/adm/sektorusaha/delete', [jukmController::class, 'delete']);

//Crud Kategori Diklat
Route::get('/adm/kategoridiklat', [KategoriController::class, 'view']);
Route::post('/adm/kategoridiklat/store', [KategoriController::class, 'store']);
Route::post('/adm/kategoridiklat/edit', [KategoriController::class, 'edit']);
Route::post('/adm/kategoridiklat/update', [KategoriController::class, 'update']);
Route::post('/adm/kategoridiklat/stat', [KategoriController::class, 'stat']);
Route::post('/adm/kategoridiklat/status', [KategoriController::class, 'status']);
Route::post('/adm/kategoridiklat/hapus', [KategoriController::class, 'hapus']);
Route::post('/adm/kategoridiklat/delete', [KategoriController::class, 'delete']);

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

//Crud Diklat
Route::get('/adm/diklat', [DiklatController::class, 'view']);
Route::post('/adm/diklat/store', [DiklatController::class, 'store']);
Route::post('/adm/diklat/edit', [DiklatController::class, 'edit']);
Route::post('/adm/diklat/update', [DiklatController::class, 'update']);
Route::post('/adm/diklat/kategori', [DiklatController::class, 'kategori']);
Route::post('/adm/diklat/kategoristore', [DiklatController::class, 'kategoristore']);
Route::post('/adm/diklat/editkategori', [DiklatController::class, 'editkategori']);
Route::post('/adm/diklat/updatekategori', [DiklatController::class, 'updatekategori']);
Route::post('/adm/diklat/hapuskategori', [DiklatController::class, 'hapuskategori']);
Route::post('/adm/diklat/deletekategori', [DiklatController::class, 'deletekategori']);
Route::post('/adm/diklat/stat', [DiklatController::class, 'stat']);
Route::post('/adm/diklat/status', [DiklatController::class, 'status']);
Route::post('/adm/diklat/hapus', [DiklatController::class, 'hapus']);
Route::post('/adm/diklat/delete', [DiklatController::class, 'delete']);

//Crud Admin
Route::get('/adm/admin', [AdminController::class, 'view']);
Route::get('/adm/admin/profile/{id_admins}', [AdminController::class, 'profile']);
Route::post('/adm/admin/store', [AdminController::class, 'store']);
Route::post('/adm/admin/edit', [AdminController::class, 'edit']);
Route::post('/adm/admin/update', [AdminController::class, 'update']);
Route::post('/adm/admin/stat', [AdminController::class, 'stat']);
Route::post('/adm/admin/status', [AdminController::class, 'status']);
Route::post('/adm/admin/hapus', [AdminController::class, 'hapus']);
Route::post('/adm/admin/delete', [AdminController::class, 'delete']);

