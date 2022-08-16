<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\dashboard\PermissionController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\InventoryController;
use App\Http\Controllers\dashboard\ProductExpires;
use App\Http\Controllers\dashboard\ProductsNew;
use App\Http\Controllers\dashboard\ProductsEgress;
use App\Http\Controllers\dashboard\ProductsExpire;
use App\Http\Controllers\dashboard\ProductsIngress;
use App\Http\Controllers\dashboard\ProductsMinStock;
use App\Http\Controllers\dashboard\TypeController;
use App\Http\Controllers\dashboard\UnitController;
use App\Http\Controllers\dashboard\Report;
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
    Route::resource('report', Report::class)->names('dashboard.report');

    Route::resource('/products-expires', ProductsExpire::class)->names('dashboard.products-expires');


    Route::post('add-unit-modal', [UnitController::class, 'addUnitModal']);
    Route::post('add-category-modal', [CategoryController::class, 'addCategoryModal']);
    Route::post('add-type-modal', [TypeController::class, 'addTypeModal']);

    Route::resources([
        'units' => UnitController::class,
        'categories' => CategoryController::class,
        'types' => TypeController::class,
    ]);

    Route::post('ajaxdata/postdata', [Controller::class, 'postdata'])->name('ajaxdata.postdata');

    Route::get('ajaxdata/fetchdata', [Controller::class, 'fetchdata'])->name('ajaxdata.fetchdata');

    //Route::get('dataTableProducts', [InventoryController::class, 'dataTable'])->name('dataTableProducts');
    Route::get('/egressByDayMes',[ Report::class, 'egressByDayMes'])->name('egressByDayMes');
    Route::get('/ingressByDayMes',[ Report::class, 'ingressByDayMes'])->name('ingressByDayMes');
    Route::resource('permissions', PermissionController::class)->names('dashboard.permissions');
    Route::post('permissions/revoke-permission-to-role', [PermissionController::class, 'revokePermissionToRole']);
    Route::post('permissions/give-permission-to-role', [PermissionController::class, 'givePermissionToRole']);
});
