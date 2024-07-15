<?php

namespace App\Repositories\Interfaces;

interface ProductInterface{
    public function createProduct($request);
    public function getProduct($id);
    public function getProducts($request);
    public function updateProduct($id,$request);
    public function deleteProduct($id);

    public function updateProductRating($id,$request);

    public function addReview($request);
}
