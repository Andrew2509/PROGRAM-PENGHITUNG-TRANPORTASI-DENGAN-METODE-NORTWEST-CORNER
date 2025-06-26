<?php

use App\Livewire\Bantuan;
use App\Livewire\Auth\Login;
use App\Livewire\Transportation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', Login::class)->name('login');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::get('/transportasi', Transportation::class)->name('transportasi');
Route::get('/bantuan', Bantuan::class)->name('bantuan');
