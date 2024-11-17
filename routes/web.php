<?php

use App\Http\Controllers\ShowProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('product', ShowProductsController::class)->name('api.products');
