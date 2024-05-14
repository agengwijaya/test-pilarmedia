<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_view_product_index_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/product');

        $response->assertStatus(200);
        $response->assertSee('Product');
    }

    public function test_can_create_product()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/product', [
            'nama' => 'Test Product',
            'harga' => 10000,
            'deskripsi' => 'Deskripsi Product',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('products', ['nama' => 'Test Product']);
    }

    public function test_can_update_product()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::create([
            'nama' => 'Test Product',
            'harga' => 10000,
            'deskripsi' => 'Deskripsi Product',
        ]);

        $response = $this->put("/product/{$product->id}", [
            'nama' => 'Updated Test Product',
            'harga' => 20000,
            'deskripsi' => 'Updated Deskripsi Product'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', ['nama' => 'Updated Test Product']);
    }

    public function test_can_delete_product()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::create([
            'nama' => 'Test Product',
            'harga' => 10000,
            'deskripsi' => 'Deskripsi Product',
        ]);

        $response = $this->delete("/product/{$product->id}");

        $response->assertRedirect();
        $this->assertDatabaseHas('products', ['id' => $product->id, 'soft_delete' => 1]);
    }
}
