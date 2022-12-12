<?php

namespace App\Http\Controllers;

use App\Jobs\ProductOrders;
use App\Jobs\OrderPayments;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Order;
use App\Models\ProductOrder;
use Illuminate\Http\Resources\Json\JsonResource as ProductsResource;
use Iamolayemi\Paystack\Facades\Paystack;
use Exception;

class OrderController extends Controller
{
    public function handleOrder(Request $request) {
        # Sort request data
            try {
                $order = $request->order;
                $phone = $order["phone"];
                $status = "awaiting_payment";
                $amount = intval($order["amount"]);
                $p_m = $order["payment_mode"];
                $fulfillment = $order["fulfillment"];
                $products = $order["products"];
            } catch(Exception $e) {
                return response(["error" => $e->getMessage()], 200);
            }

        # Configurations
            # Get product ID's and product details
                $product_id = array(); // Array of product id's

                $product_d = array(); // Array of products ordered

                // Loops through products to fetch product_details
                foreach ($products as $product) {
                    // Assign values to fit requirements
                    $data = [
                        "product_id" => $product["id"],
                        "size" => $product["size"],
                        "type" => $product["type"],
                        "writing" => $product["writing"]
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
                return response(["error" => "price verification failed"], 200);
            }

        # Verify phone
            $match = "/^([0]{1})[0-9]{10}$/";
            $verified = preg_match($match, $phone);

            if(!$verified) {
                return response(["error" => "invalid phone number"], 200);
            }

        # Insert order into "orders" table
            // Generate unique order_id
            $order_id = bin2hex(random_bytes(8));

            $order = new Order;
            $order->id = $order_id;
            $order->customer_phone = $phone;
            $order->products = json_encode($product_id);
            $order->amount = $amount;
            $order->status = $status;
            $order->payment_mode = $p_m;
            $order->fulfillment = $fulfillment;
            $order->created_at = time();
            $order->save();

        # Insert individual products to table after response...
            $data = [
                "order_id" => $order_id,
                "product_details" => $product_d,
            ];

            ProductOrders::dispatchAfterResponse($data);


        # Get payment URL
            if (!($p_m == "online")) {
                return response(["message" => "Order placed_successfully"], 200);
            }

            $reference = Paystack::generateReference();

            $data = [
                "email" => "$phone@gmail.com",
                "amount" => ($amount * 100), // amount required in kobo
                "reference" => $reference,
                "orderID" => $order_id,
                "callback_url" => "http://127.0.0.1:3000/order?order_no=$order_id"
            ];

            $url = $this->getPaymentUrl($data);

        # Insert Payment data into "order_payments" table
            $data = [
                "order_id" => $order_id,
                "url" => $url,
                "ref" => $reference
            ];

            // Insert data after response
            OrderPayments::dispatchAfterResponse($data);

        return response(["order_id" => $order_id ,"url" => $url, "ref" => $reference], 200);
    }

    public function getOrder($id) {
        $order = Order::find($id);

        if(!$order) {
            return response(["error" => "Order not found"], 200);
        }

        $order["created_at"] = date("d-M-Y h:i a", $order["created_at"]);

        return $order;
    }

    public function getProducts($id) {
        $products = ProductOrder::select(['id', 'product_id', 'cake_size', 'cake_type', 'writing'])->where('order_id', 'like', '%'.$id.'%')->get();

        return $products;
    }

    public function getProduct($id) {
        $product = Product::select(['_id','thumbnail', 'name', '_slug'])->where('_id', 'like', '%'.$id.'%')->get();

        return new ProductsResource($product);
    }

    public function verifyPayment() {
        // get reference  from request
        $reference = request('reference') ?? request('trxref');
        $order_id = request('order_id');

        // verify payment details
        $payment = Paystack::transaction()->verify($reference)->response('data');

        // check payment status
        if ($payment['status'] == 'success') {

            // Update Order table
            $order = Order::find($order_id);
            $order->status = "pending";
            $order->save();

            return response(["success" => "Payment Verified"], 200);
        } else {
            return response(["error" => "Payment not yet completed"], 200);
        }
    }

    protected function getPaymentUrl($data) {
        return Paystack::transaction()->initialize($data)->authorizationURL();
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
