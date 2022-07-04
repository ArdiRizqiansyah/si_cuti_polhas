<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// controller admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PegawaiController AS AdminPegawaiController;
use App\Http\Controllers\Admin\UpdatePegawaiController AS AdminUpdatePegawaiController;
use App\Http\Controllers\Admin\UnitController AS AdminUnitController;
use App\Http\Controllers\Admin\CutiController AS AdminCutiController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\IzinController AS AdminIzinController;
use App\Http\Controllers\Admin\LaporanController AS AdminLaporanController;
use App\Http\Controllers\Admin\SaldoController AS AdminSaldoController;

// controller pegawai
use App\Http\Controllers\Pegawai\DashboardController AS PegawaiDashboardController;
use App\Http\Controllers\Pegawai\ProfileController AS PegawaiProfileController;
use App\Http\Controllers\Pegawai\CutiController AS PegawaiCutiController;
use App\Http\Controllers\Pegawai\IzinController As PegawaiIzinController;

// controller kepala
use App\Http\Controllers\Kepala\DashboardController AS KepalaDashboardController;
use App\Http\Controllers\Kepala\ProfileController AS KepalaProfileController;
use App\Http\Controllers\Kepala\CutiController AS KepalaCutiController;
use App\Http\Controllers\Kepala\IzinController AS KepalaIzinController;
use App\Http\Controllers\Kepala\PengajuanCutiController AS KepalaPengajuanCutiController;
use App\Http\Controllers\Kepala\PengajuanIzinController AS KepalaPengajuanIzinController;
use App\Http\Controllers\Kepala\SaldoController AS KepalaSaldoController;

// controller direktur
use App\Http\Controllers\Direktur\DashboardController AS DirekturDashboardController;
use App\Http\Controllers\Direktur\CutiController AS DirekturCutiController;
use App\Http\Controllers\Direktur\IzinController AS DirekturIzinController;
use App\Http\Controllers\Direktur\ProfileController AS DirekturProfileController;
use App\Http\Controllers\Direktur\SaldoController AS DirekturSaldoController;

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
        Route::resource('pegawai', AdminPegawaiController::class)->except(['edit', 'update']);
        Route::get('pegawai/{id}/edit-akun', [AdminUpdatePegawaiController::class, 'akun'])->name('pegawai.edit.akun');
        Route::get('pegawai/{id}/edit-keluarga', [AdminUpdatePegawaiController::class, 'keluarga'])->name('pegawai.edit.keluarga');
        Route::get('pegawai/{id}/edit-pribadi', [AdminUpdatePegawaiController::class, 'pribadi'])->name('pegawai.edit.pribadi');
        Route::get('pegawai/{id}/edit-pegawai', [AdminUpdatePegawaiController::class, 'pegawai'])->name('pegawai.edit.pegawai');
        Route::put('pegawai/{id}/update-akun', [AdminUpdatePegawaiController::class, 'updateAkun'])->name('pegawai.update.akun');
        Route::put('pegawai/{id}/update-keluarga', [AdminUpdatePegawaiController::class, 'updateKeluarga'])->name('pegawai.update.keluarga');
        Route::put('pegawai/{id}/update-pribadi', [AdminUpdatePegawaiController::class, 'updatePribadi'])->name('pegawai.update.pribadi');
        Route::put('pegawai/{id}/update-pegawai', [AdminUpdatePegawaiController::class, 'updatePegawai'])->name('pegawai.update.pegawai');

        // unit routes for admin
        Route::resource('unit', AdminUnitController::class);

        // cuti routes for admin
        Route::resource('cuti', AdminCutiController::class);

        // izin routes for admin
        Route::resource('izin', AdminIzinController::class);

        // laporan routes for admin
        Route::resource('laporan', AdminLaporanController::class);

        // saldo routes for admin
        Route::get('saldo', [AdminSaldoController::class, 'index'])->name('saldo');
        Route::post('saldo/update', [AdminSaldoController::class, 'updateSaldo'])->name('saldo.update');

        // export laporan
        Route::get('download_pdf', [ExportController::class, 'laporan_pdf'])->name('laporan.export.pdf');
    });
});

// pegawai routes
Route::group(['prefix' => 'pegawai', 'middleware' => 'role:pegawai'], function() {
    Route::name('pegawai.')->group(function() {
        Route::get('/dashboard', [PegawaiDashboardController::class, 'index'])->name('dashboard');
        
        // profile routes for pegawai
        Route::get('/profile', [PegawaiProfileController::class, 'index'])->name('profile');
        Route::get('profile/keluarga', [PegawaiProfileController::class, 'keluarga'])->name('profile.keluarga');
        Route::get('profile/akun', [PegawaiProfileController::class, 'akun'])->name('profile.akun');
        Route::get('profile/pegawai', [PegawaiProfileController::class, 'pegawai'])->name('profile.pegawai');
        Route::put('profile/update-akun', [PegawaiProfileController::class, 'updateAkun'])->name('profile.update.akun');
        Route::put('profile/update-pribadi', [PegawaiProfileController::class, 'updatePribadi'])->name('profile.update.pribadi');
        Route::put('profile/update-keluarga', [PegawaiProfileController::class, 'updateKeluarga'])->name('profile.update.keluarga');
        Route::put('profile/update-pegawai', [PegawaiProfileController::class, 'updatePegawai'])->name('profile.update.pegawai');

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

        // profile routes for kepala
        Route::get('/profile', [KepalaProfileController::class, 'index'])->name('profile');
        Route::get('profile/keluarga', [KepalaProfileController::class, 'keluarga'])->name('profile.keluarga');
        Route::get('profile/akun', [KepalaProfileController::class, 'akun'])->name('profile.akun');
        Route::get('profile/pegawai', [KepalaProfileController::class, 'pegawai'])->name('profile.pegawai');
        Route::put('profile/update-akun', [KepalaProfileController::class, 'updateAkun'])->name('profile.update.akun');
        Route::put('profile/update-pribadi', [KepalaProfileController::class, 'updatePribadi'])->name('profile.update.pribadi');
        Route::put('profile/update-keluarga', [KepalaProfileController::class, 'updateKeluarga'])->name('profile.update.keluarga');
        Route::put('profile/update-pegawai', [KepalaProfileController::class, 'updatePegawai'])->name('profile.update.pegawai');

        // cuti routes for kepala
        Route::resource('cuti', KepalaCutiController::class);

        // izin routes for kepala
        Route::resource('izin', KepalaIzinController::class);

        // saldo routes for kepala
        Route::get('saldo', [KepalaSaldoController::class, 'index'])->name('saldo');

        // pengajuan cuti
        Route::resource('pengajuan-cuti', KepalaPengajuanCutiController::class);

        // pengajuan izin
        Route::resource('pengajuan-izin', KepalaPengajuanIzinController::class);
    });
});

// direktur routes
Route::group(['prefix' => 'direktur', 'middleware' => 'role:direktur'], function() {
    Route::name('direktur.')->group(function() {
        Route::get('/dashboard', [DirekturDashboardController::class, 'index'])->name('dashboard');

        // profil
        Route::get('/profile', [DirekturProfileController::class, 'index'])->name('profile');
        Route::put('/profile/update', [DirekturProfileController::class, 'update'])->name('profile.update');
        
        // cuti
        Route::resource('cuti', DirekturCutiController::class);

        // izin
        Route::resource('izin', DirekturIzinController::class);

        // saldo
        Route::get('saldo', [DirekturSaldoController::class, 'index'])->name('saldo');
    });
});