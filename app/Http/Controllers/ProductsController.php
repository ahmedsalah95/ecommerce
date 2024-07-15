<?php

namespace App\Http\Controllers;

use App\Http\Requests\addReviewRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRatingRequest;
use App\Http\Requests\UpdateProductRequest;
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

    public function getProduct($id){
        return $this->productInterface->getProduct($id);
    }

    public function getProducts(Request $request)
    {
        return $this->productInterface->getProducts($request);
    }

    public function updateProduct($id,UpdateProductRequest $request){
        return $this->productInterface->updateProduct($id,$request);
    }

    public function deleteProduct($id){
        return $this->productInterface->deleteProduct($id);
    }

    public function updateProductRating($id,UpdateProductRatingRequest $request){
        return $this->productInterface->updateProductRating($id,$request);
    }

    public function addReview(addReviewRequest $request){
        return $this->productInterface->addReview($request);
    }
}
