<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// beranada postingan
// 
// beranda (guest)
Route::get('home', [HomeController::class, 'index'])->name('home');
// ke halaman detail postingan
Route::get('postingan/{post_id}', [HomeController::class, 'show'])->name('postingan.show');
// 
// end beranda postingan

// postingan
//
// halaman postingan user (guest)
Route::get('postingan', [PostController::class, 'index'])->name('postingan');
// 
// end postingan

// 
// validasi sudah logxin atau belum 
Route::middleware('auth')->group(function () {
    
    // akun
    // 
    // update akun
    Route::post('akun/{id}', [AkunController::class, 'update'])->name('akun.update');
    // hapus foto profil
    Route::delete('akun/{id}/delete-profile', [AkunController::class, 'destroyProfil'])->name('akun.destroyProfil');
    // 
    // end akun

    // postingan
    // 
    // halman buat postingan baru
    Route::get('postingan-baru', function () {
        return view('postingan-baru',['post' => null]);
    })->name('postingan-baru');
    // simpan post baru
    Route::post('postingan-baru', [PostController::class, 'store'])->name('post.store');
    // show edit postingan
    Route::get('postingan/{post_id}/edit', [PostController::class, 'edit'])->name('postingan.edit');
    // update postingan
    Route::post('postingan/{post_id}', [PostController::class, 'update'])->name('postingan.update');
    // delete postingan
    Route::delete('postingan/{post_id}', [PostController::class, 'destroy'])->name('postingan.delete');
    //
    // end postingan
});

require __DIR__.'/auth.php';
