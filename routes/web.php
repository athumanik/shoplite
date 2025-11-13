<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SalesController;
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
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->
        name('dashboard');
});




Route::resource('pos', PosController::class)
    ->names([
        'index' => 'pos.index',
        // 'create' => 'pos.create',
        // 'store' => 'pos.store',
        // 'show' => 'pos.show',
        // 'edit' => 'pos.edit',
        // 'update' => 'pos.update',
        // 'destroy' => 'pos.destroy'
    ]);

Route::get('/pos-guest', [PosController::class, 'guest'])->name(name: 'pos.guest');


Route::resource('sales', SalesController::class)
    ->names([
        'index' => 'sales.index',
        // 'create' => 'sales.create',
        // 'store' => 'sales.store',
        // 'show' => 'sales.show',
        // 'edit' => 'sales.edit',
        // 'update' => 'sales.update',
        // 'destroy' => 'sales.destroy'
    ]);

Route::resource('inventory', InventoryController::class)
    ->names([
        'index' => 'inventory.index',
        // 'create' => 'inventory.create',
        // 'store' => 'inventory.store',
        // 'show' => 'inventory.show',
        // 'edit' => 'inventory.edit',
        // 'update' => 'inventory.update',
        // 'destroy' => 'inventory.destroy'
    ]);
