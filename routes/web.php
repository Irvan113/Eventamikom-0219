<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController; 
use App\Http\Controllers\Admin\TransactionController; 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventsController as AdminEventsController; // 
use App\Http\Controllers\Admin\CategoriesController;

// --- User Routes ---
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show'); 
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/tiket', [TicketController::class, 'index'])->name('ticket');

// --- Admin Routes ---
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/events', [AdminEventsController::class, 'index'])->name('events'); 
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');});

// --- Static Pages ---
Route::get('/tentang', function () {
    return '<h1>Ini adalah Halaman Tentang Aplikasi Event Hub</h1>';
});

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