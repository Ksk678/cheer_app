<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/index', [PlayerController::class, "index"]);

Route::get('/', [PlayerController::class, "dashboard"])
    ->name("dashboard");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('players', PlayerController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth');

Route::resource('players', PlayerController::class)
    ->only(['show', 'index']);

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

require __DIR__ . '/auth.php';


route::get("/home", [MainController::class, "home"])->name("home");
