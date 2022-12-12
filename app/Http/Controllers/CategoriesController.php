<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Http\Resources\Json\JsonResource as CategoriesResource;
use Illuminate\Http\Resources\Json\JsonResource as ProductsResource;


class CategoriesController extends Controller
{
    public function popular() {
        $categories = Category::select(['slug', 'thumbnail', 'name'])->orderBy('created_at', 'desc')->get();

        return new CategoriesResource($categories);
    }

    public function all() {

    }

    public function getProducts($slug) {
        $category_products = CategoryProduct::select(['id', 'product_id', 'category_slug'])->where('category_slug', 'like', '%'.$slug.'%')->get();

        $products = array();

        foreach($category_products as $categoryProduct) {
            // Get product ID
            $product_id = $categoryProduct["product_id"];

            // Get product using product ID
            $product = Product::select(['_id', '_slug', 'thumbnail', 'name', 'price'])->where('_id', $product_id)->first();

            array_push($products, $product);
        }

        return new ProductsResource($products);
    }
}
