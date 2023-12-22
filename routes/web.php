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
    
    Route::get('/admin/logout',[GuestController::class,'admin_logout'])->name('logout.admin');

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
    
    Route::get('/group/logout',[GuestController::class,'group_logout'])->name('logout.group');
    
});


Route::middleware(['auth','role:guest'])->group(function(){
    Route::get('/guest',[GuestController::class,'guest_page'])->name('guest.dashboard');
    Route::get('/guest/logout',[GuestController::class,'guest_logout'])->name('logout.guest');

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
   
    Route::post('/guest/rate', [GuestController::class,'rate' ])->name('rate.project');
    Route::post('/group/assign_word', [GroupController::class,'assign_word' ])->name('assign.word');
    
require __DIR__.'/auth.php';
