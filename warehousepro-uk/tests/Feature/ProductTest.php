<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Models\WarehouseLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_product()
    {
        // Create role (required for FK)
        $role = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        // Create admin user
        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $this->actingAs($user);

        // Create category
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        // Create warehouse location
        $location = WarehouseLocation::create([
            'zone' => 'A',
            'rack' => 'R1',
            'shelf' => 'S1',
            'code' => 'A-R1-S1',
        ]);

        // Send request
        $response = $this->post('/products', [
            'name' => 'Test Product',
            'price' => 100,
            'quantity' => 10,
            'category_id' => $category->id,
            'warehouse_location_id' => $location->id,
        ]);

        // Assert response
        $response->assertStatus(302);

        // Assert product exists
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 100,
            'quantity' => 10,
        ]);
    }

    public function test_staff_cannot_create_product()
    {
        // Create role (staff)
        $role = Role::create([
            'name' => 'Staff',
            'slug' => 'staff',
        ]);

        // Create staff user
        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $this->actingAs($user);

        // Create category
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        // Create warehouse location
        $location = WarehouseLocation::create([
            'zone' => 'A',
            'rack' => 'R1',
            'shelf' => 'S1',
            'code' => 'A-R1-S1',
        ]);

        // Try to create product (should FAIL)
        $response = $this->post('/products', [
            'name' => 'Unauthorized Product',
            'price' => 100,
            'quantity' => 10,
            'category_id' => $category->id,
            'warehouse_location_id' => $location->id,
        ]);

        // Assert forbidden access
        $response->assertStatus(403);

        // Assert product was NOT created
        $this->assertDatabaseMissing('products', [
            'name' => 'Unauthorized Product',
        ]);
    }
}