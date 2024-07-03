<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/dashboard', function () {
//     return view('layouts.app');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'guru'], 'as' => 'admin.'], function(){
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('user', UserController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('mapel', MapelController::class);

    Route::resource('jadwal', JadwalController::class);
    Route::get('jadwal/{jadwal}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::delete('/jadwal/{id_kelas}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

    Route::resource('nilai', NilaiController::class);
    Route::get('nilai/search', [NilaiController::class, 'search'])->name('nilai.search');
    Route::get('/nilai/{id}/edit', 'NilaiController@edit')->name('nilai.edit');
    Route::delete('/nilai/{id}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
    Route::get('/nilai/{nis}/{tahun_ajaran}/{semester}', [NilaiController::class, 'show'])->name('admin.nilai.show');

    Route::middleware(['auth:sanctum', 'siswa'])->group(function () {
        Route::get('/siswa/data', [SiswaController::class, 'getData']);
    });

});


