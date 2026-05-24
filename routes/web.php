<?php

use Illuminate\Support\Facades\Route;

// Public & User Controllers
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PartnerController; // [UPDATE 1]

// --- Sisi Publik  ---
Route::get('/', [WelcomeController::class, 'index'])->name('welcome'); // [UPDATE 2]

// --- User Routes ---
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/tiket', [TicketController::class, 'index'])->name('ticket');

// --- Admin Routes ---
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    
    Route::resource('events', EventAdminController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('categories', CategoriesController::class); 
});

// --- Static Pages ---
Route::get('/kontak', function () {
    return view('contact');
});

Route::get('/profil', function () {
    return view('profile');
});

Route::get('/katalog', function () {
    return view('catalog');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});