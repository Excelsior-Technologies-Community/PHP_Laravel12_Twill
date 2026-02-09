<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageDisplayController;

Route::get('/', [PageDisplayController::class, 'home'])
    ->name('frontend.home');

Route::get('/{slug}', [PageDisplayController::class, 'show'])
    ->name('frontend.page');

