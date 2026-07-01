<?php

use App\Models\User;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\StockMovement;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/*
|--------------------------------------------------------------------------
| CREATE ADMIN USER (INLINE EVERY TEST)
|--------------------------------------------------------------------------
*/
function createAdmin()
{
    $role = Role::firstOrCreate([
        'slug' => 'admin',
    ], [
        'name' => 'Admin',
    ]);

    return User::factory()->create([
        'role_id' => $role->id,
    ]);
}

/*
|--------------------------------------------------------------------------
| CREATE PURCHASE ORDER
|--------------------------------------------------------------------------
*/
test('admin can create purchase order', function () {

    $admin = createAdmin();
    $this->actingAs($admin);

    $supplier = Supplier::factory()->create();
    $product = Product::factory()->create(['quantity' => 10]);

    $response = $this->post(route('purchase-orders.store'), [
        'supplier_id' => $supplier->id,
        'notes' => 'Urgent order',
        'items' => [
            [
                'product_id' => $product->id,
                'quantity' => 5,
            ],
        ],
    ]);

    $response->assertRedirect(route('purchase-orders.index'));

    $this->assertDatabaseHas('purchase_orders', [
        'supplier_id' => $supplier->id,
        'status' => 'pending',
    ]);
});

/*
|--------------------------------------------------------------------------
| VALIDATION TEST
|--------------------------------------------------------------------------
*/
test('purchase order validation works', function () {

    $admin = createAdmin();
    $this->actingAs($admin);

    $response = $this->post(route('purchase-orders.store'), []);

    $response->assertSessionHasErrors([
        'supplier_id',
        'items',
    ]);
});

/*
|--------------------------------------------------------------------------
| INDEX PAGE
|--------------------------------------------------------------------------
*/
test('admin can view purchase orders list', function () {

    $admin = createAdmin();
    $this->actingAs($admin);

    $response = $this->get(route('purchase-orders.index'));

    $response->assertStatus(200);
});

/*
|--------------------------------------------------------------------------
| SHOW PAGE
|--------------------------------------------------------------------------
*/
test('admin can view purchase order details', function () {

    $admin = createAdmin();
    $this->actingAs($admin);

    $po = PurchaseOrder::factory()->create();

    $response = $this->get(route('purchase-orders.show', $po));

    $response->assertStatus(200);
});

/*
|--------------------------------------------------------------------------
| APPROVE
|--------------------------------------------------------------------------
*/
test('admin can approve purchase order', function () {

    $admin = createAdmin();
    $this->actingAs($admin);

    $po = PurchaseOrder::factory()->create([
        'status' => 'pending',
    ]);

    $response = $this->post(route('purchase-orders.approve', $po));

    $response->assertSessionHas('success');

    $this->assertDatabaseHas('purchase_orders', [
        'id' => $po->id,
        'status' => 'approved',
    ]);
});

/*
|--------------------------------------------------------------------------
| RECEIVE (STOCK UPDATE)
|--------------------------------------------------------------------------
*/
test('admin can receive purchase order and update stock', function () {

    $admin = createAdmin();
    $this->actingAs($admin);

    $product = Product::factory()->create(['quantity' => 10]);
    $supplier = Supplier::factory()->create();

    $po = PurchaseOrder::factory()->create([
        'supplier_id' => $supplier->id,
        'status' => 'approved',
        'ordered_by' => $admin->id,
    ]);

    $po->items()->create([
        'product_id' => $product->id,
        'quantity' => 5,
    ]);

    $response = $this->post(route('purchase-orders.receive', $po));

    $response->assertSessionHas('success');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'quantity' => 15,
    ]);

    $this->assertDatabaseHas('stock_movements', [
        'product_id' => $product->id,
        'type' => 'stock_in',
    ]);
});

/*
|--------------------------------------------------------------------------
| CANCEL
|--------------------------------------------------------------------------
*/
test('admin can cancel purchase order', function () {

    $admin = createAdmin();
    $this->actingAs($admin);

    $po = PurchaseOrder::factory()->create([
        'status' => 'pending',
    ]);

    $response = $this->post(route('purchase-orders.cancel', $po));

    $response->assertSessionHas('success');

    $this->assertDatabaseHas('purchase_orders', [
        'id' => $po->id,
        'status' => 'cancelled',
    ]);
});

/*
|--------------------------------------------------------------------------
| ACCESS CONTROL
|--------------------------------------------------------------------------
*/
test('staff cannot access purchase orders module', function () {

    $role = Role::firstOrCreate([
        'slug' => 'staff',
    ], [
        'name' => 'Staff',
    ]);

    $staff = User::factory()->create([
        'role_id' => $role->id,
    ]);

    $this->actingAs($staff);

    $response = $this->get(route('purchase-orders.index'));

    $response->assertStatus(403);
});