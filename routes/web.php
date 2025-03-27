<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\exelController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('excel', exelController::class);