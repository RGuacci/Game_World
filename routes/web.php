<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::livewire('/','pages::games.welcome')->name('home');
// Auth Routes
Route::livewire('/register','pages::auth.register')->name('register');
Route::livewire('/login','pages::auth.login')->name('login');