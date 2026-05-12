<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// beranada postingan
// 
// beranda (guest)
Route::get('home', [HomeController::class, 'index'])->name('home');
// validasi sudah logxin atau belum 
Route::middleware('auth')->group(function () {
    // postingan
    // 
    // halman buat postingan baru
    Route::get('postingan/create', function () {
        return view('postingan.create',['post' => null]);
    })->name('postingan.create');
    // simpan post baru
    Route::post('postingan/store', [PostController::class, 'store'])->name('post.store');
    // show edit postingan
    Route::get('postingan/{post_id}/edit', [PostController::class, 'edit'])->name('postingan.edit');
    // update postingan
    Route::put('postingan/{post_id}', [PostController::class, 'update'])->name('postingan.update');
    // delete postingan
    Route::delete('postingan/{post_id}', [PostController::class, 'destroy'])->name('postingan.destroy');
    // akun
    // 
    // update akun
    Route::put('akun/{id}', [AkunController::class, 'update'])->name('akun.update');
    // hapus foto profil
    Route::delete('akun/{id}/delete-profile', [AkunController::class, 'destroyProfil'])->name('akun.destroyProfil'); 
});

// halaman postingan 
Route::get('postingan/index', [PostController::class, 'index'])->name('postingan.index');
// ke halaman detail postingan
Route::get('postingan/{post_id}', [PostController::class, 'show'])->name('postingan.show');
// 

require __DIR__.'/auth.php';
