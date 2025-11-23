<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\WholesaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->
        name('dashboard');
});




Route::get('stocks', [StockController::class, 'index'])->name(name: 'stocks');
Route::get('stock-guest', [StockController::class, 'guest'])->name(name: 'stock.guest');

Route::get('pos-guest', [PosController::class, 'guest'])->name(name: 'pos.guest');
Route::get('pos', [PosController::class, 'index'])->name(name: 'pos');


Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('product', [ProductController::class, 'main'])->name(name: 'product');

Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);



Route::get('orders', [OrderController::class, 'index'])->name(name: 'orders');
Route::get('report', [ReportController::class, 'index'])->name(name: 'report');
Route::get('expense', [ExpenseController::class, 'index'])->name(name: 'expense');
Route::get('wholesale', [WholesaleController::class, 'index'])->name(name: 'wholesale');

Route::get('order', [OrderController::class, 'main'])->name(name: 'order');
Route::get('reports', [ReportController::class, 'main'])->name(name: 'reports');
Route::get('expenses', [ExpenseController::class, 'main'])->name(name: 'expenses');
Route::get('wholesales', [WholesaleController::class, 'main'])->name(name: 'wholesales');


// Sales
Route::get('selling', [SalesController::class, 'sales'])->name('sales');

Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::post('/sales', [SalesController::class, 'store']);
Route::get('/sales/{id}', [SalesController::class, 'show']);
Route::put('/sales/{id}', [SalesController::class, 'update']);
Route::delete('/sales/{id}', [SalesController::class, 'destroy']);


Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory', [InventoryController::class, 'store']);
Route::get('/inventory/{id}', [InventoryController::class, 'show']);
Route::put('/inventory/{id}', [InventoryController::class, 'update']);
Route::delete('/inventory/{id}', [InventoryController::class, 'destroy']);

Route::get('inventories', [InventoryController::class, 'main'])->name(name: 'inventories');



Route::get('shops', [ShopController::class, 'index'])->name(name: 'shops');
Route::get('shop', [ShopController::class, 'main'])->name(name: 'shop');

