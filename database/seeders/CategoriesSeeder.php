<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => rand(0, 20),
                'thumbnail' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80',
                'name' => 'Chocolate Cakes',
                'created_at' => Carbon::now()
            ],
            [
                'id' => rand(0, 20),
                'thumbnail' => 'https://images.unsplash.com/photo-1606983340126-99ab4feaa64a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80',
                'name' => 'Birthday Cakes',
                'created_at' => Carbon::now()
            ],
            [
                'id' => rand(0, 20),
                'thumbnail' => 'https://images.unsplash.com/photo-1623428454614-abaf00244e52?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80',
                'name' => 'Wedding Cakes',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
