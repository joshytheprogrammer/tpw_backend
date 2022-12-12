<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Http\Resources\Json\JsonResource as CategoriesResource;


class CategoriesController extends Controller
{
    public function popular() {
        $categories = Category::select(['id', 'thumbnail', 'name'])->orderBy('created_at', 'desc')->get();

        return new CategoriesResource($categories);
    }

    public function all() {

    }

    public function getProducts($slug) {
        return CategoryProduct::select(['id', 'product_id', 'category_slug'])->where('category_slug', 'like', '%'.$slug.'%')->get();
    }
}
