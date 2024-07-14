<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Repositories\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $productInterface;

    public function __construct(ProductInterface $productInterface){
        $this->productInterface = $productInterface;
    }
    public function createProduct(CreateProductRequest $request){
        return $this->productInterface->createProduct($request);
    }
}
