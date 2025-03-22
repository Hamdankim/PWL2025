<?php
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);
    Route::post('/ajax', [UserController::class, 'store_ajax']);
    Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']); // Menampilkan halaman daftar level
    Route::post('/list', [LevelController::class, 'list']); // Menampilkan data level dalam bentuk JSON untuk DataTables
    Route::get('/create', [LevelController::class, 'create']); // Menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']); // Menyimpan data level baru
    Route::get('/{id}', [LevelController::class, 'show']); // Menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']); // Menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']); // Menyimpan perubahan data level
    Route::delete('/{id}', [LevelController::class, 'destroy']); // Menghapus data level
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']); // Menampilkan halaman daftar kategori
    Route::post('/list', [KategoriController::class, 'list']); // Menampilkan data kategori dalam bentuk JSON untuk DataTables
    Route::get('/create', [KategoriController::class, 'create']); // Menampilkan halaman form tambah kategori
    Route::post('/', [KategoriController::class, 'store']); // Menyimpan data kategori baru
    Route::get('/{id}', [KategoriController::class, 'show']); // Menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']); // Menampilkan halaman form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']); // Menyimpan perubahan data kategori
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // Menghapus data kategori
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']); // Menampilkan halaman awal barang
    Route::post('/list', [BarangController::class, 'list']); // Menampilkan data barang dalam bentuk JSON untuk DataTables
    Route::get('/create', [BarangController::class, 'create']); // Menampilkan halaman form tambah barang
    Route::post('/', [BarangController::class, 'store']); // Menyimpan data barang baru
    Route::get('/{id}', [BarangController::class, 'show']); // Menampilkan detail barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']); // Menampilkan halaman form edit barang
    Route::put('/{id}', [BarangController::class, 'update']); // Menyimpan perubahan data barang
    Route::delete('/{id}', [BarangController::class, 'destroy']); // Menghapus data barang
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/', [StokController::class, 'index']); // Menampilkan halaman awal barang
    Route::post('/list', [StokController::class, 'list']); // Menampilkan data barang dalam bentuk JSON untuk DataTables
    Route::get('/create', [StokController::class, 'create']); // Menampilkan halaman form tambah barang
    Route::post('/', [StokController::class, 'store']); // Menyimpan data barang baru
    Route::get('/{id}', [StokController::class, 'show']); // Menampilkan detail barang
    Route::get('/{id}/edit', [StokController::class, 'edit']); // Menampilkan halaman form edit barang
    Route::put('/{id}', [StokController::class, 'update']); // Menyimpan perubahan data barang
    Route::delete('/{id}', [StokController::class, 'destroy']); // Menghapus data barang
});

