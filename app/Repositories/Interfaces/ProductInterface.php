<?php

namespace App\Repositories\Interfaces;

interface ProductInterface{
    public function createProduct($request);
    public function getProduct($id);
    public function updateProduct($id,$request);
    public function deleteProduct($id);
}
