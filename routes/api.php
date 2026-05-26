<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MahasiswaApiController;

Route::get('/mahasiswa', [MahasiswaApiController::class, 'index']);
Route::get('/mahasiswa/{mahasiswa}', [MahasiswaApiController::class, 'show']);
