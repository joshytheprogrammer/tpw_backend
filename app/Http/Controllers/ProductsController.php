<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource as ProductsResource;

class ProductsController extends Controller
{

    public function show($slug) {
        $product = Product::select(['thumbnail', 'name', 'price'])->where('_slug', 'like', '%'.$slug.'%')->get();
        return new ProductsResource($product);
    }

    public function recommended() {
        $products = Product::select(['_id', '_slug', 'thumbnail', 'name', 'price'])->orderBy('created_at', 'desc')->get();

        return new ProductsResource($products);
    }
}
