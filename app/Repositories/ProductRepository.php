<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductInterface
{

    use ApiResponse;
    public function createProduct($request): JsonResponse
    {
        $user = Auth::user();
        if(!$user->hasRole('Admin')){
           return $this->error("you don't have permission to create product",401);
        }
        $product = Product::create($request->all());
        return $this->success( $product,'Product created successfully', 201);
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        if(!$product){
            return $this->error("Product not found",404);
        }
        return $this->success($product,'Product retrieved successfully', 200);
    }

    public function updateProduct($id,$request): JsonResponse
    {
        $user = Auth::user();
        if (!$user->hasRole('Admin')) {
            return $this->error("You don't have permission to update a product", 401);
        }

        $product = Product::find($id);
        if (!$product) {
            return $this->error("Product not found", 404);
        }

        $product->update($request->all());
        return $this->success($product, 'Product updated successfully', 200);
    }

    public function deleteProduct($id)
    {
        $user = Auth::user();
        if (!$user->hasRole('Admin')) {
            return $this->error("You don't have permission to delete a product", 401);
        }

        $product = Product::find($id);
        if (!$product) {
            return $this->error("Product not found", 404);
        }

        $product->delete();
        return $this->success([], 'Product deleted successfully', 204);
    }
}
