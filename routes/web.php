<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\TouristeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', [HomeController::class, 'redirectUser'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






require __DIR__.'/auth.php';



Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

});


Route::middleware(['auth', 'proprietaire'])->prefix('proprietaire')->name('proprietaire.')->group(function () {
    Route::get('/dashboard', [ProprietaireController::class, 'index'])->name('dashboard');
    Route::get('/annonces/ajouter', [ProprietaireController::class, 'createAnnonce'])->name('annonces.create');
    Route::post('/annonces', [ProprietaireController::class, 'storeAnnonce'])->name('annonces.store');
    Route::get('/annonces/{annonce}/edit', [ProprietaireController::class, 'editAnnonce'])->name('annonces.edit');
    Route::put('/annonces/{annonce}', [ProprietaireController::class, 'updateAnnonce'])->name('annonces.update');

    Route::get('/profile', [ProprietaireController::class, 'showProfile'])->name('profile.show');

    Route::get('/profile/edit', [ProprietaireController::class, 'editProfile'])->name('profile.edit');

    Route::put('/profile', [ProprietaireController::class, 'updateProfile'])->name('profile.update');
});


Route::middleware(['auth', 'touriste'])->prefix('touriste')->name('touriste.')->group(function () {
    Route::get('/', [TouristeController::class, 'index'])->name('index');

    Route::get('/dashboard', [TouristeController::class, 'dashboard'])->name('dashboard');
    Route::put('/dashboard/update', [TouristeController::class, 'updateProfile'])->name('dashboard.update');

    Route::get('/annonces', [TouristeController::class, 'indexAnnonces'])->name('annonces.index');
    Route::get('/annonces/{annonce}', [TouristeController::class, 'showAnnonce'])->name('annonces.show');

    Route::post('/annonces/{annonce}/buy', [TouristeController::class, 'buyAnnonce'])->name('annonces.buy');

    Route::post('/annonces/{annonce}/favorite', [FavoriController::class, 'toggleFavorite'])->name('annonces.favorite.toggle');

    Route::post('/payment/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');

    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
});
