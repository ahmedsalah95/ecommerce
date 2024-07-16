<?php
namespace App\Repositories;

use App\Events\ProductRatingUpdated;
use App\Models\Product;
use App\Models\Review;
use App\Repositories\Interfaces\ProductInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class ProductRepository implements ProductInterface
{

    use ApiResponse;
    public function createProduct($request): JsonResponse
    {
        try{
            $user = Auth::user();
            if(!$user->hasRole('Admin')){
                return $this->error("you don't have permission to create product",401);
            }
            $product = Product::create($request->all());
            return $this->success( $product,'Product created successfully', 201);
        }catch (\Exception $e){
            return $this->error($e,422);
        }

    }

    public function getProduct($id)
    {
        $product = Product::where('id',$id)->with('reviews')->first();
        if(!$product){
            return $this->error("Product not found",404);
        }
        return $this->success($product,'Product retrieved successfully', 200);
    }



    public function getProducts($request)
    {
        $cacheKey = 'products_' . md5(json_encode($request->all()));
        $cacheTags = ['products'];

        if ($request->has('category_id')) {
            $cacheTags[] = 'category_' . $request->category_id;
        }
        if(Cache::has($cacheKey)){
            return Cache::get($cacheKey);
        }
        return Cache::tags($cacheTags)->remember($cacheKey, 60, function () use ($request) {
            $products = Product::query();

            if ($request->has('category_id')) {
                $products->where('category_id', $request->category_id);
            }
            if ($request->has('category_name')) {
                $products->whereHas('category', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->category_name . '%');
                });
            }
            if ($request->has('name')) {
                $products->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->has('order_by') && $request->order_by === 'rating') {
                $direction = $request->has('direction') && $request->direction === 'desc' ? 'desc' : 'asc';
                $products->orderBy('rating', $direction);
            }

            return $products->with('reviews')->paginate(15);
        });
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

    public function updateProductRating($id,$request){


        $product = Product::where('id',$id)->with('reviews')->first();
        if(!$product){
            return $this->error("Product not found", 404);
        }
        $averageRating = $product->reviews->avg('rating');
        $product->update(['rating' => $averageRating]);
        ProductRatingUpdated::dispatch($product);
        return $this->success($product,"product rate updated successfully", 200);
    }


    public function addReview($request)
    {
        $product = Product::find($request->product_id);
        if(!$product){
            return $this->error("Product not found", 404);
        }
        $newReview = Review::create($request->all());
        return $this->success($newReview,"review added successfully", 200);

    }
}
