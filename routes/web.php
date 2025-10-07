<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\AdresseController;
use App\Http\Controllers\PaiementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
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


Route::resource('categories', CategorieController::class);
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');

Route::resource('puzzles', PuzzleController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('paniers', PanierController::class)->parameters([
        'paniers' => 'puzzle'
    ]);
    Route::post('/paniers/{puzzle}', [PanierController::class, 'store'])->name('paniers.store');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/adresses', [AdresseController::class, 'show'])->name('adresses.show');
    Route::post('/adresses', [AdresseController::class, 'store'])->name('adresses.store');
    Route::put('/adresses/{adresse}', [AdresseController::class, 'update'])->name('adresses.update');
    Route::delete('/adresses/{adresse}', [AdresseController::class, 'destroy'])->name('adresses.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/paiements/{adresse?}', [PaiementController::class, 'index'])->name('paiements.index');
    Route::get('/paiements/cheque/{adresse?}', [PaiementController::class, 'cheque'])->name('paiements.cheque');
    Route::get('/paiements/paypal/{adresse?}', [PaiementController::class, 'paypal'])->name('paiements.paypal');
});

Route::view('/erreur-connexion', 'erreur-connexion')->name('erreur.connexion');
