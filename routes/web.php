<?php

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



Route::get('login', [App\Http\Controllers\Auth\AuthController::class, 'index'])->name('login');

Route::post('post-login', [App\Http\Controllers\Auth\AuthController::class, 'postLogin'])->name('login.post');

Route::get('registration', [App\Http\Controllers\Auth\AuthController::class, 'registration'])->name('register');

Route::post('post-registration', [App\Http\Controllers\Auth\AuthController::class, 'postRegistration'])->name('register.post');

Route::get('dashboard', [App\Http\Controllers\Auth\AuthController::class, 'dashboard']);

Route::get('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
Route::get('/barang', function () {
    return view('page.barang');
});

Route::get('/barang/datatable', [App\Http\Controllers\BarangController::class, 'datatable'])->name('barang/datatable');
Route::post('/barang/save', [App\Http\Controllers\BarangController::class, 'save'])->name('barang/save');
Route::post('/barang/hapus', [App\Http\Controllers\BarangController::class, 'hapus'])->name('barang/hapus');

Route::get('/satuan', function () {
    return view('page.satuan');
});
Route::get('/satuan/datatable', [App\Http\Controllers\SatuanController::class, 'datatable'])->name('satuan/datatable');
Route::post('/satuan/save', [App\Http\Controllers\SatuanController::class, 'save'])->name('satuan/save');
Route::post('/satuan/hapus', [App\Http\Controllers\SatuanController::class, 'hapus'])->name('satuan/hapus');

Route::get('/gudang', function () {
    return view('page.gudang');
});
Route::get('/gudang/datatable', [App\Http\Controllers\GudangController::class, 'datatable'])->name('gudang/datatable');
Route::post('/gudang/save', [App\Http\Controllers\GudangController::class, 'save'])->name('gudang/save');
Route::post('/gudang/hapus', [App\Http\Controllers\GudangController::class, 'hapus'])->name('gudang/hapus');

Route::get('/user', function () {
    return view('page.user');
});
Route::get('/user/datatable', [App\Http\Controllers\UserController::class, 'datatable'])->name('user/datatable');
Route::post('/user/save', [App\Http\Controllers\UserController::class, 'save'])->name('user/save');
Route::post('/user/hapus', [App\Http\Controllers\UserController::class, 'hapus'])->name('user/hapus');

Route::get('/staff', function () {
    return view('page.staff');
});
Route::get('/staff/datatable', [App\Http\Controllers\StaffController::class, 'datatable'])->name('staff/datatable');
Route::post('/staff/save', [App\Http\Controllers\StaffController::class, 'save'])->name('staff/save');
Route::post('/staff/hapus', [App\Http\Controllers\StaffController::class, 'hapus'])->name('staff/hapus');

Route::get('/hakakses', function () {
    return view('page.hakakses');
});
Route::get('/hakakses/datatable', [App\Http\Controllers\HakaksesController::class, 'datatable'])->name('hakakses/datatable');
Route::post('/hakakses/save', [App\Http\Controllers\HakaksesController::class, 'save'])->name('hakakses/save');
Route::post('/hakakses/hapus', [App\Http\Controllers\HakaksesController::class, 'hapus'])->name('hakakses/hapus');

Route::get('/katagori', function () {
    return view('page.katagori');
});
Route::get('/katagori/datatable', [App\Http\Controllers\KatagoriController::class, 'datatable'])->name('katagori/datatable');
Route::post('/katagori/save', [App\Http\Controllers\KatagoriController::class, 'save'])->name('katagori/save');
Route::post('/katagori/hapus', [App\Http\Controllers\KatagoriController::class, 'hapus'])->name('katagori/hapus');
