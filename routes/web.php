<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'store']);

Route::get('/link', [DownloadController::class, 'index']);
