<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\AdresseController;

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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('puzzles', PuzzleController::class);
Route::resource('categories', CategorieController::class)->middleware('auth');
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');

Route::resource('paniers', PanierController::class);
Route::post('/panier/{puzzle}', [PanierController::class, 'store'])->name('paniers.store');
Route::patch('/panier/{puzzle}', [PanierController::class, 'update'])->name('paniers.update');
Route::delete('/panier/{puzzle}', [PanierController::class, 'destroy'])->name('paniers.destroy');

Route::get('/adresse', [AdresseController::class, 'index'])->name('adresse.index');
Route::post('/adresse', [AdresseController::class, 'store'])->name('adresse.store');
Route::put('/adresse/{adresse}', [AdresseController::class, 'update'])->name('adresse.update');
