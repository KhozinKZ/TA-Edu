<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('auth/login');
});


Route::get('/', function () {
    // Periksa apakah pengguna sudah terautentikasi
    if (auth()->check()) {
       // Periksa apakah ada URL sebelumnya yang disimpan dalam sesi
        if (session()->has('previous_url')) {
              // Jika ada URL sebelumnya, dapatkan dan arahkan ke sana
            return redirect()->to(session()->pull('previous_url'));
        } else {
              // Jika tidak ada URL sebelumnya, arahkan berdasarkan peran pengguna
            if (auth()->user()->hasRole('Admin')) {
                return redirect('/home');
            } elseif (auth()->user()->hasRole('Pembeli')) {
                return redirect('/beranda');
            }
        }
    }

// Jika pengguna belum terautentikasi, arahkan kembali ke halaman login
    return redirect('/login');
});





Auth::routes();

Route::middleware('auth')->group(function () {
    // Tempatkan semua rute yang ingin Anda lindungi di sini
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/pakaian',App\Http\Controllers\PakaianController::class);
    Route::get('/api/pakaian', [App\Http\Controllers\PakaianController::class, 'api']);

    Route::resource('/ukuran',App\Http\Controllers\UkuranController::class);
    Route::get('/api/ukuran', [App\Http\Controllers\UkuranController::class, 'api']);

    Route::resource('/barang',App\Http\Controllers\BarangController::class);
    Route::get('/api/barang', [App\Http\Controllers\BarangController::class, 'api']);
    Route::post('/barang/handleForm', [App\Http\Controllers\BarangController::class, 'handleForm'])->name('barang.handleForm');
    // Route::post('/barang/index', [App\Http\Controllers\BarangController::class, 'index']);
    Route::post('/barang/index', [App\Http\Controllers\BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/detail/{barang}', [App\Http\Controllers\BarangController::class, 'show'])->name('barang.detail');

    Route::resource('/beranda',App\Http\Controllers\BerandaController::class);
    Route::get('/api/beranda', [App\Http\Controllers\BerandaController::class, 'api']);

    Route::resource('/keranjang',App\Http\Controllers\KeranjangController::class);
    Route::get('/api/keranjang', [App\Http\Controllers\KeranjangController::class, 'api']);
    Route::post('/keranjang/index', [App\Http\Controllers\KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/simpan', [App\Http\Controllers\KeranjangController::class, 'simpan'])->name('keranjang.simpan');


    Route::resource('/bayar', App\Http\Controllers\TransaksiController::class);
    Route::get('/api/bayar', [App\Http\Controllers\TransaksiController::class, 'api']);
    Route::post('/bayar/index', [App\Http\Controllers\TransaksiController::class, 'index'])->name('bayar.index');
    Route::get('/data-transaksi', [App\Http\Controllers\TransaksiController::class, 'getData']);


});
 // semua rute yang terdaftar di dalam grup tersebut akan dilindungi oleh middleware auth. Jadi jika pengguna mencoba mengakses salah satu rute dalam grup tanpa login, mereka akan diarahkan kembali ke halaman login.




// Route::post('/barang/idForm', [App\Http\Controllers\BarangController::class, 'idForm'])->name('barang.idForm');

// Route::get('/barang/{id}/edit', [App\Http\Controllers\BarangController::class, 'edit'])->name('barang.edit');



Route::get('test_spatie', [App\Http\Controllers\AdminController::class, 'test_spatie']);