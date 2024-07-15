<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\Interfaces\ProductInterface;

class ProductsController extends Controller
{
    protected $productInterface;

    public function __construct(ProductInterface $productInterface){
        $this->productInterface = $productInterface;
    }
    public function createProduct(CreateProductRequest $request){
        return $this->productInterface->createProduct($request);
    }

    public function getProduct($id){
        return $this->productInterface->getProduct($id);
    }

    public function updateProduct($id,UpdateProductRequest $request){
        return $this->productInterface->updateProduct($id,$request);
    }

    public function deleteProduct($id){
        return $this->productInterface->deleteProduct($id);
    }
}
