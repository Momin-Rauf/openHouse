<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GroupController;
use App\Http\Middleware\Role;
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




Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin.dashboard');

});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth','role:group'])->group(function(){
    Route::get('/group',[GroupController::class,'group_page'])->name('group.dashboard');
    
});


Route::middleware(['auth','role:guest'])->group(function(){
    Route::get('/guest',[GuestController::class,'guest_page'])->name('guest.dashboard');

});






Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/user', [AdminController::class, 'create_user'])->name('create_user');
    Route::get('/admin/assign', [AdminController::class, 'assignProjectsToGuests'])->name('admin.assign');
   
    
require __DIR__.'/auth.php';
