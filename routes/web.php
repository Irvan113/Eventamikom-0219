<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\AuthController; // Ditambahkan untuk Login
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\EventController as EventAdminController;

// --- User Routes ---
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/tiket', [TicketController::class, 'index'])->name('ticket');

// Redirect dari halaman utama /login ke halaman login admin
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// --- Admin Routes ---
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    
    // 1. Rute Auth Admin (Bebas Akses / Public)
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // 2. Rute Administrasi (Di dalam Group Admin)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    Route::resource('categories', CategoriesController::class)->except(['show']);
    Route::resource('partners', PartnerController::class)->except(['show']);
    
    // Resource untuk CRUD Event Admin
    Route::resource('events', EventAdminController::class);
});
Route::get('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'create'])->name('checkout.create'); 

Route::post('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store'); 

Route::get('/payment/{order_id}', [\App\Http\Controllers\CheckoutController::class, 'payment'])->name('checkout.payment'); 

Route::get('/success/{order_id}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success'); 


// --- Static Pages ---
Route::get('/', [HomeController::class, 'index']);

Route::get('/kontak', function () {
    return view('contact');
});

Route::get('/profil', function () {
    return view('profile');
});

Route::get('/katalog', function () {
    return view('catalog');
})->name('catalog');

Route::get('/bantuan', function () {
    return view('bantuan');
});