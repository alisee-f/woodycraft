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

/* --- Puzzles --- */
Route::resource('puzzles', PuzzleController::class);

/* --- Catégories --- */
Route::resource('categories', CategorieController::class)->middleware('auth');
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');

/* --- Panier --- */
Route::resource('paniers', PanierController::class);
Route::post('/paniers/{puzzle}', [PanierController::class, 'store'])->name('paniers.store');
Route::patch('/paniers/{puzzle}', [PanierController::class, 'update'])->name('paniers.update');
Route::delete('/paniers/{puzzle}', [PanierController::class, 'destroy'])->name('paniers.destroy');

/* --- Adresses --- */
Route::middleware(['auth'])->group(function () {
    Route::get('/adresses', [AdresseController::class, 'show'])->name('adresses.show');
    Route::post('/adresses', [AdresseController::class, 'store'])->name('adresses.store');
    Route::put('/adresses/{adresse}', [AdresseController::class, 'update'])->name('adresses.update');
    Route::delete('/adresses/{adresse}', [AdresseController::class, 'destroy'])->name('adresses.destroy');
});
