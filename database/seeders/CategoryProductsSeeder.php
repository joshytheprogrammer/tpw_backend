<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_products')->insert([
            [
                'product_id' => 'gwer435t',
                'category_slug' => 'birthday-cakes'
            ],
            [
                'product_id' => 'flr34tnb',
                'category_slug' => 'birthday-cakes'
            ],
            [
                'product_id' => 'reft45th',
                'category_slug' => 'birthday-cakes'
            ],
            [
                'product_id' => 'f5643g0b',
                'category_slug' => 'birthday-cakes'
            ],
            [
                'product_id' => 'fre456ty',
                'category_slug' => 'wedding-cakes'
            ],
        ]);
    }
}
