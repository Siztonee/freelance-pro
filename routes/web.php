<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Livewire\Home;
use App\Livewire\Profile\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');


    //profile
Route::middleware('auth')->group(function () {
    Route::get('/user/{uuid}', Profile::class)->name('user.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('user.profile.update');
});

    //search
Route::post('/search-spec', [SearchController::class, 'searchSpec'])->name('search.spec');
Route::post('/search-skill', [SearchController::class, 'searchSkill'])->name('search.skill');


//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
