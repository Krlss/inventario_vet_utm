<?php

use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\InventoryController;
use App\Http\Controllers\dashboard\ProductExpires;
use App\Http\Controllers\dashboard\ProductsNew;
use App\Http\Controllers\dashboard\ProductsEgress;
use App\Http\Controllers\dashboard\ProductsExpire;
use App\Http\Controllers\dashboard\ProductsIngress;
use App\Http\Controllers\dashboard\ProductsMinStock;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/jetstream.php';
require_once __DIR__ . '/fortify.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::get('/products_minstock', [ProductsMinStock::class, 'index'])->name("dashboard.products-minstock");
    Route::get('/products_expire', [ProductExpires::class, 'index'])->name("dashboard.products-expire");
    Route::post('/products', [ProductsNew::class, 'store']);

    Route::resource('/inventory', InventoryController::class)->names('dashboard.inventory');
    Route::resource('/products-ingress', ProductsIngress::class)->names('dashboard.products-ingress');
    Route::resource('/products-egress', ProductsEgress::class)->names('dashboard.products-egress');
    Route::resource('/products', ProductsNew::class)->names('dashboard.products');
    Route::resource('/products-expires', ProductsExpire::class)->names('dashboard.products-expires');
    //Route::get('dataTableProducts', [InventoryController::class, 'dataTable'])->name('dataTableProducts');
});
