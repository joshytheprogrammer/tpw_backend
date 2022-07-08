<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource as ProductsResource;

class HomeController extends Controller
{
    public function recommended() {
        $products = Product::select(['_id', '_slug', 'thumbnail', 'name', 'price'])->orderBy('created_at', 'desc')->get();

        return new ProductsResource($products);
    }
}
