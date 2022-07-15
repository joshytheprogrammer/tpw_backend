<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function getFormat($id) {
        $format = Config::select(['format', "configurable"])->where('product_id', 'like', '%'.$id.'%')->get();
        return $format;
    }
}
