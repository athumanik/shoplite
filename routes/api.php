<?php

use App\Http\Controllers\API\ExpenseController;
use App\Http\Controllers\API\InventoryController;
use App\Http\Controllers\API\PosController;
use App\Http\Controllers\API\ShopController;
use App\Http\Controllers\API\StatsController;
use App\Http\Controllers\API\WholeSaleController;
use App\Http\Controllers\API\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\SalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/pos', [PosController::class, 'index']);
Route::get('/pos/{product}', [PosController::class, 'show']);

Route::post('/pos-orders', [PosController::class, 'order']); // hold sale -> orders + order_items
Route::post('/pos-sales', [PosController::class, 'sales']);   // complete sale -> sales + sales_items

Route::get('/stocks', [StockController::class, 'index']);
Route::get('/stock/{product}', [StockController::class, 'show']);
Route::post('/stock', [StockController::class, 'stock']);
Route::post('/stocking', [StockController::class, 'store']);


Route::get('/products/stats', [ProductController::class, 'stats']);
Route::get('/product', [ProductController::class, 'product']);
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::prefix('inventory')->group(function () {
    Route::get('/', [InventoryController::class, 'index']);      // GET all
    Route::get('{id}', [InventoryController::class, 'show']);    // GET single
    Route::post('/', [InventoryController::class, 'store']);     // CREATE
    Route::put('{id}', [InventoryController::class, 'update']);  // UPDATE
    Route::delete('{id}', [InventoryController::class, 'destroy']); // DELETE
});

Route::get('/expenses', [ExpenseController::class, 'index']);
Route::post('/expenses', [ExpenseController::class, 'store']);
Route::get('/expenses/{id}', [ExpenseController::class, 'show']);
Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);

Route::get('/expenses-stats', [ExpenseController::class, 'stats']);


Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);


Route::get('/sale', [SalesController::class, 'sales']);
Route::get('/sales', [SalesController::class, 'index']);
Route::post('/sales', [SalesController::class, 'store']);
Route::get('/sales/{id}', [SalesController::class, 'show']);
Route::put('/sales/{id}', [SalesController::class, 'update']);
Route::delete('/sales/{id}', [SalesController::class, 'destroy']);


// Stats
Route::get('/stats/sales', [StatsController::class, 'stats']);




Route::get('/wholesales', [WholeSaleController::class, 'index']);
Route::post('/wholesales', [WholeSaleController::class, 'store']);
Route::get('/wholesales/{id}', [WholeSaleController::class, 'show']);
Route::put('/wholesales/{id}', [WholeSaleController::class, 'update']);
Route::delete('/wholesales/{id}', [WholeSaleController::class, 'destroy']);


Route::get('/shop', [ShopController::class, 'index']);
Route::post('/shop', [ShopController::class, 'store']);
Route::get('/shop/{id}', [ShopController::class, 'show']);
Route::put('/shop/{id}', [ShopController::class, 'update']);
Route::delete('/shop/{id}', [ShopController::class, 'destroy']);




