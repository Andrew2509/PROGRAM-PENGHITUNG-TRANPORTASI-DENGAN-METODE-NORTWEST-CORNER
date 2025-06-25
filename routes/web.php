<?php

use App\Livewire\Transportation;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Transportation::class);