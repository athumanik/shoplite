<?php

use App\Http\Controllers\CashController;
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



Route::get('shops', [ShopController::class, 'index'])->name(name: 'shops');
Route::get('shop', [ShopController::class, 'main'])->name(name: 'shop');


Route::get('stocks', [StockController::class, 'index'])->name(name: 'stocks');
Route::get('stock-guest', [StockController::class, 'guest'])->name(name: 'stock.guest');

Route::get('pos-guest', [PosController::class, 'guest'])->name(name: 'pos.guest');
// Route::get('pos', [PosController::class, 'index'])->name(name: 'pos');

Route::prefix('pos')->group(function () {
    Route::get('/', [PosController::class, 'index'])->name('pos');      // GET all
    Route::get('{id}', [PosController::class, 'show']);    // GET single
    Route::post('/', [PosController::class, 'store']);     // CREATE
    Route::put('{id}', [PosController::class, 'update']);  // UPDATE
    Route::delete('{id}', [PosController::class, 'destroy']); // DELETE
});



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

Route::prefix('sales')->group(function () {
    Route::get('/', [SalesController::class, 'index'])->name('sales.index');      // GET all
    Route::get('{id}', [SalesController::class, 'show']);    // GET single
    Route::post('/', [SalesController::class, 'store']);     // CREATE
    Route::put('{id}', [SalesController::class, 'update']);  // UPDATE
    Route::delete('{id}', [SalesController::class, 'destroy']); // DELETE
});

Route::get('inventories', [InventoryController::class, 'main'])->name(name: 'inventories');

Route::prefix('inventory')->group(function () {
    Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');      // GET all
    Route::get('{id}', [InventoryController::class, 'show']);    // GET single
    Route::post('/', [InventoryController::class, 'store']);     // CREATE
    Route::put('{id}', [InventoryController::class, 'update']);  // UPDATE
    Route::delete('{id}', [InventoryController::class, 'destroy']); // DELETE
});


Route::get('cashier', [CashController::class, 'index'])->name('cash');









