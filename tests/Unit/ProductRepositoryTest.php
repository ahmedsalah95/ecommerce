<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
        $this->artisan('db:seed', ['--class' => 'CategorySeeder']);
        $this->artisan('db:seed', ['--class' => 'ProductSeeder']);
        $this->artisan('db:seed', ['--class' => 'UserSeeder']);
    }


    public function test_CreateProductSuccess()
    {
        $user = User::factory()->create();
        $user->addRole('Admin');
        $this->actingAs($user);

        $requestData = [
            'name' => 'Product Name',
            'description' => 'Product desc',
            'price' => 100,
            'category_id' => 1,
        ];

        $request = new Request($requestData);
        $productRepository = new ProductRepository();
        $response = $productRepository->createProduct($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->status());
        $this->assertArrayHasKey('data', $response->getData(true));
        $this->assertDatabaseHas('products', ['name' => 'Product Name']);
    }

    public function test_GetProductSuccess()
    {

        $user = User::factory()->create();
        $user->addRole('Admin');
        $this->actingAs($user);


        $categories = Category::all();
        $product = Product::create([
            'name' => 'Product Name',
            'description' => 'Product desc',
            'price' => 100,
            'category_id' => $categories->random()->id,
        ]);

        $productRepository = new ProductRepository();
        $response = $productRepository->getProduct($product->id);


        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('data', $response->getData(true));
    }

    public function test_UpdateProductSuccess()
    {
        $categories = Category::all();

        $user = User::factory()->create();
        $user->addRole('Admin');
        $this->actingAs($user);

        $product = Product::create([
            'name' => 'Old Product Name',
            'description' => 'Old Product desc',
            'price' => 100,
            'category_id' => $categories->random()->id,
        ]);

        $requestData = [
            'name' => 'New Product Name',
            'description' => 'New Product desc',
            'price' => 150,
        ];

        $request = new Request($requestData);
        $productRepository = new ProductRepository();
        $response = $productRepository->updateProduct($product->id, $request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('data', $response->getData(true));
        $this->assertDatabaseHas('products', ['name' => 'New Product Name']);
    }
}
