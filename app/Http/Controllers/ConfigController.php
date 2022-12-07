<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function getFormat($id) {
        $format = Config::select(['format', "configuration"])->where('product_id', 'like', '%'.$id.'%')->get();
        return $format;
    }

    public function getCost(Request $request) {
        $price = 0;

        $product_id = $request['product_id'];
        $type = $request['type'];
        $size = $request['size'];

        $config = Config::select(['base_price'])->where('product_id', 'like', '%'.$product_id.'%')->first();

        $base_price = $config->base_price;
        // 7000

        $price = $base_price + $this->getTypeCost($type) + $this->getSizeCost($size);

        return $price;
    }

    public function verifyCost($data) {
        $price = 0;

        $product_id = $data['product_id'];
        $type = $data['type'];
        $size = $data['size'];

        $config = Config::select(['base_price'])->where('product_id', 'like', '%'.$product_id.'%')->first();

        $base_price = $config->base_price;
        // 7000

        $price = $base_price + $this->getTypeCost($type) + $this->getSizeCost($size);

        return $price;
    }

    protected function getSizeCost($size) {
        // 10 = 3000, 12 = 4000, 14 = 6000

        if($size == 8) {
            return 0;
        }else if($size == 10) {
            return 3500; // We make 500
        }else if($size == 12) {
            return 5000; // We make 1000
        }else if($size == 14) {
            return 8000; // We make 2000
        }
    }

    protected function getTypeCost($type) {
        //  rv = 2500, cc = 3000, fc = 4000
        if($type == "sc") {
            return 0;
        }else if($type == "rv") {
            return 3000; // we make 500
        }else if($type == "cc") {
            return 5000; // We make 2000
        }else if($type == "fc") {
            return 7000; // We make 3000
        }
    }
}
