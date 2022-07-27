<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Order;

class OrderController extends Controller
{
    public function handleOrder(Request $request) {
        # Sort request data
            $order = $request->order;

            $phone = $order["phone"];
            $status = $order["status"];
            $amount = $order["amount"];
            $p_m = $order["payment_mode"];
            $products = $order["products"];
            $fulfillment = $order["fulfillment"];

        # Configurations
            # Get product ID's and product details
                $product_id = array(); // Array of product id's

                $product_d = array();

                // Loops through products to fetch product_details
                foreach ($products as $product) {
                    // Assign values to fit requirements
                    $data = [
                        "product_id" => $product["id"],
                        "size" => $product["size"],
                        "type" => $product["type"],
                    ];

                    // Push data to product_details array
                    array_push($product_d, $data);

                    // Push only id's to product_id array
                    array_push($product_id, $product["id"]);
                }

        # Verify price
            $verified = $this->verifyPrice($amount, $product_d);

            // Kill request if price verification fails
            if(!$verified) {
                return response("price verification failed", 412);
            }

        # Insert order into "orders" table
            $order = new Order;
            $order->customer_phone = $phone;
            $order->products = $product_id;
            $order->amount = $amount;
            $order->status = $status;
            $order->payment_mode = $p_m;
            $order->fulfillment = $fulfillment;
            $order->save();
        // Mode -> online
            // Call pay function and return payment link
        // Mode -> offline
            // return order_placed_successfully and proceed to 'order page'
        
        # Insert individual products to product_orders table
            // Insert, [order_id, product_id, quantity, size, type, writing] (for loop)

    }

    protected function verifyPrice($amount, $product) {
        # Set data
        $tax = 12; 
        $price = 0;
        
        # Get the cost of each item
        foreach ($product as $item) {
            $price = $price + $this->getCost($item);
        }

        # Add taxes to total cost
        $price = $price + ($price / 100) * $tax;

        # Return false if amount and price don't match
        if(!($amount == $price)) {
            return false;
        }

        # Return true if price is verified
        return true;
    }

    protected function order() {

    }

    protected function getCost($data) {
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
