<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            # Get product ID's
                $product_id = array(); // Array of product id's

                // Loops through products to fetch its id
                foreach ($products as $product) {
                    array_push($product_id, $product["id"]);
                }

            # Get product details
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
                }

        # Verify price
            $verified = $this->verifyPrice($amount, $product_d);

            // Kill request if price verification fails
            if(!$verified) {
                return response("price verification failed", 412);
            }

            return $verified;

        # Insert order into "orders" table
            // Seperate product id's (for loop)
            // Status -> awaiting_payment
            // Fulfillment -> pickup
            // Mode -> online
                // Call pay function and return payment link
            // Mode -> offline
                // return order_placed_successfully and proceed to 'order page'
        // Create Laravel Jobs, queue
        // Insert individual products to product_orders table
            // Insert, [order_id, product_id, quantity, size, type, writing] (for loop)

    }


    protected function verifyPrice($amount, $product) {
        // Call the getCost function for each id 
        $prices = array();
        $url = 'http://127.0.0.1:8000/api/config/getCost/';
        
        foreach ($product as $item) {
            
            $price = Http::post($url, $item);

            array_push($prices, $price);
        }

        return $product;
    }

    protected function order() {

    }
}
