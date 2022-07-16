<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Facades\Redis;

class ConfigController extends Controller
{
    public function getFormat($id) {
        $format = Config::select(['format', "configurable"])->where('product_id', 'like', '%'.$id.'%')->get();
        return $format;
    }

    public function getCost(Request $request) {
        $price = 0;

        $product_id = $request['product_id'];
        $type = $request['type'];
        $size = $request['size'];

        $config = Config::select(['base_price'])->where('product_id', 'like', '%'.$product_id.'%')->first();
        
        $base_price = $config->base_price;

        $price = $base_price + $this->getTypeCost($type) + $this->getSizeCost($size);

        return $price;
    }

    protected function getSizeCost($size) {
        // 10 = 2500, 12 = 5000, 14 = 10000

        if($size == 8) {
            return 0;
        }else if($size == 10) {
            return 2500;
        }else if($size == 12) {
            return 5000;
        }else if($size == 14) {
            return 10000;
        }
        
    }

    protected function getTypeCost($type) {
        // cc = 2500, fc = 5000, rv = 7500
        if($type == "sc") {
            return 0;
        }else if($type == "cc") {
            return 2500;
        }else if($type == "fc") {
            return 5000;
        }else if($type == "rv") {
            return 7500;
        }
    }
}
