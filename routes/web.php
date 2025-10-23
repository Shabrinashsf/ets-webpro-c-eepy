<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/room', [RoomController::class, 'index'])->name('room');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/signup', [UserController::class, 'signup'])->name('register');
Route::post('login',[UserController::class, 'logincheck'])->name('logincheck');
Route::post('signup',[UserController::class, 'registercheck'])->name('registercheck');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/admin', [UserController::class, 'adminDashboard'])->name('admin');
    Route::get('/admin/rooms', [UserController::class, 'manageRooms'])->name('admin.rooms');

    Route::get('/booking', [BookingController::class, 'show'])->name('booking');
    Route::post('/book-now', [BookingController::class, 'store'])->name('booking.store');

    Route::get('/orders', function () {
        return view('dashboard-user', ['active' => 'orders', 'user' => Auth::user()]);
    })->name('orders');

    Route::get('/success', function () {
        return view('success');
    })->name('success');

    Route::post('/logout', function (Request $request) {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect()->route('home'); 
    })->name('logout');
});