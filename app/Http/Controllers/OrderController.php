<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        # Verify price 
        $product_id = array(); // Array of product id's

        // Loops through products to fetch its id
        foreach ($products as $product) {
            array_push($product_id, $product["id"]);
        }

        // Verify Price
        $verified = $this->verifyPrice($amount, $product_id);

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
        // foreach
        return true;
    }

    protected function order() {

    }
}
