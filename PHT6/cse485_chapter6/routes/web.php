<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'showHomePage']);
Route::get('/about', [PageController::class, 'showHomePage']);


