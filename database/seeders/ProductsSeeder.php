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
                '_id' => substr(bin2hex(random_bytes(32)), 0, 8),
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1650226544/tec/products/edited_image_with_label_vrbcdx.png', 
                'name' => '10 inch Double Layer Whipped Cream Cake',
                'price' => json_encode(["lowest" => "20500", "highest" => "27500"]),
                'created_at' => Carbon::now()
            ],
            [
                '_id' => substr(bin2hex(random_bytes(32)), 0, 8),
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1649158427/tec/products/1D22D433-FA9A-43A8-B46B-7DB3715FE0C6_pv1wsw.jpg', 
                'name' => 'Single Layer 8 inch Butter Cream Cake',
                'price' => json_encode(["lowest" => "6000", "highest" => "14000"]),
                'created_at' => Carbon::now()
            ],
            [
                '_id' => substr(bin2hex(random_bytes(32)), 0, 8),
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1649163828/tec/products/IMG_6212_leid3k.jpg', 
                'name' => 'Single Layer 10 inch Butter Cream Cake',
                'price' => json_encode(["lowest" => "25000", "highest" => "30000"]),
                'created_at' => Carbon::now()
            ],
            [
                '_id' => substr(bin2hex(random_bytes(32)), 0, 8),
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1649158052/tec/products/signal-2022-04-05-122625_001_zrzlp3.jpg', 
                'name' => 'Butter Cream Cake With Chocolate Drip',
                'price' => json_encode(["lowest" => "12000", "highest" => "19000"]),
                'created_at' => Carbon::now()
            ],
            [
                '_id' => substr(bin2hex(random_bytes(32)), 0, 8),
                'thumbnail' => 'https://res.cloudinary.com/dsgvwxygr/image/upload/v1650224468/tec/products/enhanced_image_1_nxnoxo.jpg', 
                'name' => 'Simple Two Tier Wedding Cake',
                'price' => json_encode(["lowest" => "50000", "highest" => "70000"]),
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
