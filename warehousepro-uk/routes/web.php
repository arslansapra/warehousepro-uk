<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseLocationController;
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //Categories Route
    Route::resource('/categories', CategoryController::class);
    //WarehouseLocations Route
    Route::resource('/warehouse-locations', WarehouseLocationController::class);
    //Products Route
    Route::resource('/products', ProductController::class );
    //Stock Movement Route
    Route::resource('stock-movements',StockMovementController::class
    )->only([
        'index',
        'create',
        'store'
    ]);

});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/users', function(){
        return 'User Management by Admin Only';
    });
});
require __DIR__.'/auth.php';
