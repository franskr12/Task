<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    // Rute untuk tampilan beranda
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Rute untuk membuat dan menyimpan tugas
    Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
    Route::post('/tasks', [App\Http\Controllers\HomeController::class, 'store'])->name('task.store');

    // Rute untuk mengedit dan menghapus tugas
    Route::get('/tasks/{task}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('task.edit');
    Route::delete('/tasks/{task}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('task.destroy');

    // Rute untuk menandai tugas sebagai selesai
    Route::post('/mark-as-done/{task}', 'TaskController@markAsDone')->name('mark-as-done');
    Route::post('/mark-as-done/{task}', 'HomeController@markAsDone')->name('mark-as-done');
});

