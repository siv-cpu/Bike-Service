<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth','admin']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard',[HomeController::class,'index']);
    Route::resource('services', ServiceController::class);
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('bookings/{id}/ready', [BookingController::class, 'markAsReady'])->name('bookings.ready');
    Route::post('bookings/{id}/completed', [BookingController::class, 'markAsCompleted'])->name('bookings.completed');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my_bookings');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cusbookings', [BookingController::class, 'myBookings'])->name('bookings.my_bookings');
    Route::get('/cusbookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/cusbookings', [BookingController::class, 'store'])->name('bookings.store');
});
require __DIR__.'/auth.php';
