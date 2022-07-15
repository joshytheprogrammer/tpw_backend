<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                '_id' => 'gwer435t',
                '_slug' => '10-inch-double-layer-whipped-cream-cake-with-chocolates-on-top-gwer435t',
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1650226544/tec/products/edited_image_with_label_vrbcdx.png', 
                'name' => '10 inch Double Layer Whipped Cream Cake with chocolates on top',
                'price' => json_encode(["lowest" => "20500", "highest" => "40000"]),
                'created_at' => Carbon::now()
            ],
            [
                '_id' => 'flr34tnb',
                '_slug' => '10-inch-double-layer-butter-cream-cake-with-gold-coins-flr34tnb',
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1649158427/tec/products/1D22D433-FA9A-43A8-B46B-7DB3715FE0C6_pv1wsw.jpg', 
                'name' => '10 inch Double Layer Butter Cream Cake with Gold Coins',
                'price' => json_encode(["lowest" => "14000", "highest" => "35000"]),
                'created_at' => Carbon::now()
            ],
            [
                '_id' => 'reft45th',
                '_slug' => '10-inch-single-layer-butter-cream-cake-with-spiderman-topping-reft45th',
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1649163828/tec/products/IMG_6212_leid3k.jpg', 
                'name' => '10 inch Single layer Butter Cream Cake with Spiderman topping',
                'price' => json_encode(["lowest" => "13500", "highest" => "32000"]),
                'created_at' => Carbon::now()
            ],
            [
                '_id' => 'f5643g0b',
                '_slug' => '10-inch-double-layer-butter-cream-cake-with-chocolate-drip-and-gold-coins-f5643g0b',
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1649158052/tec/products/signal-2022-04-05-122625_001_zrzlp3.jpg', 
                'name' => '10 inch Double layer butter cream cake with chocolate drip and gold coins',
                'price' => json_encode(["lowest" => "16000", "highest" => "35000"]),
                'created_at' => Carbon::now()
            ],
            [
                '_id' => 'fre456ty',
                '_slug' => 'simple-two-tier-wedding-cake-fre456ty',
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1650224468/tec/products/enhanced_image_1_nxnoxo.jpg', 
                'name' => 'Simple Two Tier Wedding Cake',
                'price' => json_encode(["lowest" => "50000", "highest" => "70000"]),
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
