<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
        $this->artisan('db:seed', ['--class' => 'CategorySeeder']);
        $this->artisan('db:seed', ['--class' => 'ProductSeeder']);
        $this->artisan('db:seed', ['--class' => 'UserSeeder']);
    }

    protected function getUserToken()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;
        return $token;
    }

    public function test_CreateProduct()
    {
        $token = $this->getUserToken();

        dd($token);
        $category = Category::first();

        $requestData = [
            'name' => 'Product Name',
            'description' => 'Product description',
            'price' => 100,
            'category_id' => $category->id,
        ];

        $response = $this->postJson('/api/products', $requestData, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'price',
                'category_id',
                'created_at',
                'updated_at',
            ],
        ]);
        $this->assertDatabaseHas('products', ['name' => 'Product Name']);
    }

    public function test_GetProduct()
    {
        $token = $this->getUserToken();

        $product = Product::first();

        $response = $this->getJson('/api/products/' . $product->id, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'price',
                'category_id',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function test_UpdateProduct()
    {
        $token = $this->getUserToken();

        $product = Product::first();

        $requestData = [
            'name' => 'Updated Product Name',
            'description' => 'Updated Product description',
            'price' => 150,
        ];

        $response = $this->putJson('/api/products/' . $product->id, $requestData, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'price',
                'category_id',
                'created_at',
                'updated_at',
            ],
        ]);
        $this->assertDatabaseHas('products', ['name' => 'Updated Product Name']);
    }

    public function test_DeleteProduct()
    {
        $token = $this->getUserToken();

        $product = Product::first();

        $response = $this->deleteJson('/api/products/' . $product->id, [], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}

