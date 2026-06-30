<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseLocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH USERS (ALL LOGGED IN USERS)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard (ALL ROLES)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Notifications (ALL ROLES)
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/notifications/{notification}/read',
        [NotificationController::class, 'markAsRead']
    )->name('notifications.read');

    // Profile (ALL ROLES)
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN + WAREHOUSE MANAGER
|--------------------------------------------------------------------------
| FULL INVENTORY + PO WORKFLOW
*/

Route::middleware(['auth', 'role:admin,warehouse_manager'])->group(function () {

    Route::resource('categories', CategoryController::class);

    Route::resource('warehouse-locations', WarehouseLocationController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('purchase-orders', PurchaseOrderController::class);

    Route::post('purchase-orders/{purchaseOrder}/approve',
        [PurchaseOrderController::class, 'approve']
    )->name('purchase-orders.approve');

    Route::post('purchase-orders/{purchaseOrder}/receive',
        [PurchaseOrderController::class, 'receive']
    )->name('purchase-orders.receive');

    Route::post('purchase-orders/{purchaseOrder}/cancel',
        [PurchaseOrderController::class, 'cancel']
    )->name('purchase-orders.cancel');

    Route::resource('stock-movements', StockMovementController::class)
        ->only(['index', 'create', 'store']);
});

/*
|--------------------------------------------------------------------------
| PRODUCTS (VIEW ACCESS CONTROLLED IN POLICY)
|--------------------------------------------------------------------------
|
| IMPORTANT:
| We allow all authenticated users to hit routes,
| BUT real restriction is handled in ProductPolicy.
|
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/users', function () {
        return 'User Management - Admin Only';
    });

});

require __DIR__.'/auth.php';