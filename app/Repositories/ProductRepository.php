<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductInterface;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductInterface
{

    use ApiResponse;
    public function createProduct($request)
    {
        $user = Auth::user();
        if(!$user->hasRole('Admin')){
           return $this->error("you don't have permission to create product",401);
        }
        $product = Product::create($request->all());
        return $this->success( $product,'Product created successfully', 201);
    }
}
