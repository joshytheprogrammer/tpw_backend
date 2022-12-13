<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource as ProductsResource;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request["query"];

        $products = $this->searchProductColumns($query);

        return $products;
    }

    protected function rankSearch() {

    }

    protected function searchProductColumns($query) {
        return Product::select(['_id', '_slug', 'thumbnail', 'name', 'price'])
        ->where('_slug', 'like', '%'.$query.'%')
        ->orWhere('_id', 'like', '%'.$query.'%')
        ->orWhere('thumbnail', 'like', '%'.$query.'%')
        ->orWhere('name', 'like', '%'.$query.'%')
        ->get();
    }
}
