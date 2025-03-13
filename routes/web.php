<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Pet\PetController;

Route::get('/', function () {
    return redirect()->route('pets.index');
})->name('home');

Route::get('dashboard', function () {
    return redirect()->route('pets.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('pets', PetController::class);

Route::fallback(function () {
    return redirect()->route('pets.index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
