<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgramStudiController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('mahasiswa', MahasiswaController::class);

Route::resource('program-studi', ProgramStudiController::class)
    ->parameters(['program-studi' => 'programStudi'])
    ->except(['show']);
    