<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Characters
    Route::get('/characters', [App\Http\Controllers\CharacterController::class, 'index'])->name('get-characters');
    Route::get('/characters/{character}', [App\Http\Controllers\CharacterController::class, 'show'])->name('get-character');
    Route::get('/characters/{character}', [App\Http\Controllers\CharacterController::class, 'edit'])->name('edit-character');
    Route::put('/characters/{character}', [App\Http\Controllers\CharacterController::class, 'update'])->name('update-character');
});



require __DIR__.'/auth.php';
