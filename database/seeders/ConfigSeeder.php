<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config')->insert([
            // These define the type of cake inside
            // sc - sponge cake, rv - red velvet, cc - chocolate cake, fc - fruit cake
            [
                'product_id' => 'gwer435t',
                'format' => json_encode(["size" => "10", "type" => "sc"]),
                'base_price' => '20500',
                'configuration' => true,
            ],
            [
                'product_id' => 'flr34tnb',
                'format' => json_encode(["size" => "10", "type" => "rv"]),
                'base_price' => '14000',
                'configuration' => true,
            ],
            [
                'product_id' => 'reft45th',
                'format' => json_encode(["size" => "10", "type" => "sc"]),
                'base_price' => '13500',
                'configuration' => true,
            ],
            [
                'product_id' => 'f5643g0b',
                'format' => json_encode(["size" => "10", "type" => "cc"]),
                'base_price' => '16000',
                'configuration' => true,
            ],
            [
                'product_id' => 'fre456ty',
                'format' => null,
                'base_price' => '50000',
                'configuration' => false,
            ]
        ]);

    }
}
