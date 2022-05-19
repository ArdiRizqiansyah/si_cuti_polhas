<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// controller admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PegawaiController AS AdminPegawaiController;
use App\Http\Controllers\Admin\UnitController AS AdminUnitController;
use App\Http\Controllers\Admin\CutiController AS AdminCutiController;
use App\Http\Controllers\Admin\IzinController AS AdminIzinController;
use App\Http\Controllers\Admin\LaporanController AS AdminLaporanController;

// controller pegawai
use App\Http\Controllers\Pegawai\DashboardController AS PegawaiDashboardController;
use App\Http\Controllers\Pegawai\ProfileController AS PegawaiProfileController;
use App\Http\Controllers\Pegawai\CutiController AS PegawaiCutiController;
use App\Http\Controllers\Pegawai\IzinController As PegawaiIzinController;

// controller kepala
use App\Http\Controllers\Kepala\DashboardController AS KepalaDashboardController;
use App\Http\Controllers\Kepala\CutiController AS KepalaCutiController;
use App\Http\Controllers\Kepala\IzinController AS KepalaIzinController;

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

// Route::get('/', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');

// authentication routes
Route::controller(AuthController::class)->group(function() {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'post_login'])->name('post.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function() {
    Route::name('admin.')->group(function() {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // pegawai routes for admin
        Route::resource('pegawai', AdminPegawaiController::class);

        // unit routes for admin
        Route::resource('unit', AdminUnitController::class);

        // cuti routes for admin
        Route::resource('cuti', AdminCutiController::class);

        // izin routes for admin
        Route::resource('izin', AdminIzinController::class);

        // laporan routes for admin
        Route::resource('laporan', AdminLaporanController::class);
    });
});

// pegawai routes
Route::group(['prefix' => 'pegawai', 'middleware' => 'role:pegawai'], function() {
    Route::name('pegawai.')->group(function() {
        Route::get('/dashboard', [PegawaiDashboardController::class, 'index'])->name('dashboard');
        
        // profile routes for pegawai
        Route::get('/profile', [PegawaiProfileController::class, 'index'])->name('profile');
        Route::put('/profile/{id}', [PegawaiProfileController::class, 'update'])->name('profile.update');

        // cuti routes for pegawai
        Route::resource('cuti', PegawaiCutiController::class);

        // izin routes for pegawai
        Route::resource('izin', PegawaiIzinController::class);
    });
});

// kepala routes
Route::group(['prefix' => 'kepala', 'middleware' => 'role:kepala'], function() {
    Route::name('kepala.')->group(function() {
        Route::get('/dashboard', [KepalaDashboardController::class, 'index'])->name('dashboard');

        // cuti routes for kepala
        Route::resource('cuti', KepalaCutiController::class);

        // izin routes for kepala
        Route::resource('izin', KepalaIzinController::class);
    });
});