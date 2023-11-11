<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\SignataireController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('petitions.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/petitions', [PetitionController::class, 'index'])->name('petitions.index');
    Route::get('/petitions/create', [PetitionController::class, 'create'])->name('petitions.create');
    Route::post('/petitions', [PetitionController::class, 'store'])->name('petitions.store');
    Route::get('/petitions/{petition}/edit', [PetitionController::class, 'edit'])->name('petitions.edit');
    Route::put('/petitions/{petition}', [PetitionController::class, 'update'])->name('petitions.update');
    Route::delete('/petitions/{petition}', [PetitionController::class, 'destroy'])->name('petitions.destroy');
    Route::post('/petitions/{petition}/signataires', [SignataireController::class, 'store'])->name('signataires.store');
    Route::get('/petitions/{petition}/export', [PetitionController::class, 'exportSignataires'])->name('petitions.export');
});

Route::get('/petitions/{petition}', [PetitionController::class, 'show'])->name('petitions.show');

require __DIR__.'/auth.php';
