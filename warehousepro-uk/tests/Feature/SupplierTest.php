<?php

use App\Models\User;
use App\Models\Role;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

/*
|--------------------------------------------------------------------------
| HELPER: Create user with role slug
|--------------------------------------------------------------------------
*/
function createUserWithRole(string $slug): User
{
    $role = Role::create([
        'name' => ucfirst($slug),
        'slug' => $slug,
    ]);

    return User::factory()->create([
        'role_id' => $role->id,
    ]);
}

/*
|--------------------------------------------------------------------------
| INDEX
|--------------------------------------------------------------------------
*/
test('admin can view suppliers list', function () {

    $admin = createUserWithRole('admin');

    $this->actingAs($admin);

    $response = $this->get(route('suppliers.index'));

    $response->assertStatus(200);
    $response->assertViewIs('suppliers.index');
});

/*
|--------------------------------------------------------------------------
| CREATE PAGE
|--------------------------------------------------------------------------
*/
test('admin can view create supplier page', function () {

    $admin = createUserWithRole('admin');

    $this->actingAs($admin);

    $response = $this->get(route('suppliers.create'));

    $response->assertStatus(200);
    $response->assertViewIs('suppliers.create');
});

/*
|--------------------------------------------------------------------------
| STORE
|--------------------------------------------------------------------------
*/
test('admin can create supplier', function () {

    $admin = createUserWithRole('admin');

    $this->actingAs($admin);

    $data = [
        'company_name' => 'ABC Traders',
        'contact_person' => 'John Doe',
        'email' => 'abc@test.com',
        'phone' => '123456789',
        'address' => 'London UK',
        'is_active' => true,
    ];

    $response = $this->post(route('suppliers.store'), $data);

    $response->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'email' => 'abc@test.com',
        'company_name' => 'ABC Traders',
    ]);
});

/*
|--------------------------------------------------------------------------
| VALIDATION
|--------------------------------------------------------------------------
*/
test('supplier validation works', function () {

    $admin = createUserWithRole('admin');

    $this->actingAs($admin);

    $response = $this->post(route('suppliers.store'), []);

    $response->assertSessionHasErrors([
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
        'is_active',
    ]);
});

/*
|--------------------------------------------------------------------------
| EDIT
|--------------------------------------------------------------------------
*/
test('admin can view edit supplier page', function () {

    $admin = createUserWithRole('admin');

    $this->actingAs($admin);

    $supplier = Supplier::factory()->create();

    $response = $this->get(route('suppliers.edit', $supplier));

    $response->assertStatus(200);
    $response->assertViewIs('suppliers.edit');
});

/*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/
test('admin can update supplier', function () {

    $admin = createUserWithRole('admin');

    $this->actingAs($admin);

    $supplier = Supplier::factory()->create();

    $response = $this->put(route('suppliers.update', $supplier), [
        'company_name' => 'Updated Company',
        'contact_person' => 'Jane Doe',
        'email' => 'updated@test.com',
        'phone' => '999999',
        'address' => 'Manchester UK',
        'is_active' => false,
    ]);

    $response->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'email' => 'updated@test.com',
    ]);
});

/*
|--------------------------------------------------------------------------
| DELETE
|--------------------------------------------------------------------------
*/
test('admin can delete supplier', function () {

    $admin = createUserWithRole('admin');

    $this->actingAs($admin);

    $supplier = Supplier::factory()->create();

    $response = $this->delete(route('suppliers.destroy', $supplier));

    $response->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseMissing('suppliers', [
        'id' => $supplier->id,
    ]);
});

/*
|--------------------------------------------------------------------------
| ACCESS CONTROL
|--------------------------------------------------------------------------
*/
test('staff cannot access suppliers module', function () {

    $staff = createUserWithRole('staff');

    $this->actingAs($staff);

    $response = $this->get(route('suppliers.index'));

    $response->assertStatus(403);
});