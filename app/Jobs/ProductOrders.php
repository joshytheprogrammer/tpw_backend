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

    public $data;

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

        foreach ($data["product_details"] as $i) {
            $product_order = new ProductOrder;
            
            $product_order->order_id = $data["order_id"];
            $product_order->product_id = $i["product_id"];
            $product_order->quantity = 1;
            $product_order->cake_size = $i["size"];
            $product_order->cake_type = $i["type"];
            $product_order->writing = $i["writing"];

            $product_order->save();
        }

    }
}
