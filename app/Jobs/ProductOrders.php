<?php

namespace App\Jobs;

use App\Models\ProductOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    public $p_o;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;

        foreach ($data as $i) {
            $product_order = new ProductOrder;

            $product_order->order_id = $i["order_id"];
            $product_order->product_id = $i["product_details"]["product_id"];
            $product_order->quantity = 1;
            $product_order->cake_size = $i["product_details"]["size"];
            $product_order->cake_type = $i["product_details"]["type"];
            $product_order->writing = $i["product_details"]["writing"];

            $product_order->save();
        }

    }
}
