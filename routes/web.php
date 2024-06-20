<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CreateProjectController;
use App\Http\Controllers\CreateServiceController;
use App\Http\Controllers\Profile\AddPortfolio;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\SettingsController;
use App\Http\Controllers\SearchController;
use App\Livewire\Home;
use App\Livewire\Profile\PortfolioInfo;
use App\Livewire\Profile\Portfolios;
use App\Livewire\Profile\Profile;
use App\Livewire\Project\MyProjects;
use App\Livewire\Project\ProjectInfo;
use App\Livewire\Project\Projects;
use App\Livewire\Service\ServiceInfo;
use App\Livewire\Service\Services;
use App\Livewire\Service\MyServices;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');


Route::middleware('auth')->group(function () {

    //    profile
    Route::get('/user/{uuid}', Profile::class)->name('user.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/profile/settings', SettingsController::class)->name('user.profile.settings');

    //    portfolio
    Route::get('/profile/{uuid}/portfolios', Portfolios::class)->name('user.portfolio.list');
    Route::get('/profile/{uuid}/portfolio/{id}', PortfolioInfo::class)->name('user.portfolio.info');
    Route::get('/profile/add-portfolio', [AddPortfolio::class, 'index'])->name('user.portfolio.add');
    Route::post('/profile/add-portfolio', [AddPortfolio::class, 'add'])->name('user.portfolio.post');

    //    services
    Route::get('/services', Services::class)->name('services');
    Route::get('/my-services', MyServices::class)->name('user.services');
    Route::get('/my-services/create', [CreateServiceController::class, 'index'])->name('user.services.create');
    Route::post('/my-services/create', [CreateServiceController::class, 'store'])->name('user.services.store');


    //    projects
    Route::get('/projects', Projects::class)->name('projects');
    Route::get('/my-projects', MyProjects::class)->name('user.projects');
    Route::get('/my-projects/create', [CreateProjectController::class, 'index'])->name('user.projects.create');
    Route::post('/my-projects/create', [CreateProjectController::class, 'store'])->name('user.projects.store');


    //    chat
    Route::get('/chat', [ChatController::class, 'index'])->name('user.chat');


    //search
Route::post('/search-spec', [SearchController::class, 'searchSpec'])->name('search.spec');
Route::post('/search-skill', [SearchController::class, 'searchSkill'])->name('search.skill');
Route::post('/search-freelancer', [SearchController::class, 'searchFreelancer'])->name('search.freelancer');
Route::post('/search-freelancers-by-skills', [SearchController::class, 'searchBySkills'])->name('search.freelancer.skills');

});

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
