<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function handleOrder(Request $request) {
        // Sort request data
        $order = $request->order;

        $phone = $order["phone"];
        $status = $order["status"];
        $amount = $order["amount"];
        $p_m = $order["payment_mode"];
        $products = $order["products"];
        $fulfillment = $order["pickup"];

        // Verify price 
        

            // [return "price verification failed" if failed.]
        // Insert Order into database
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

        // return $amount;
    }


    protected function verifyPrice($amount, $id) {
        // amount if the total price of the product
        // id is an array of product id's

        // foreach
    }
}
