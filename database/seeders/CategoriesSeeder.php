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
                'id' => rand(0, 9999999),
                'thumbnail' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80',
                'name' => 'Chocolate Cakes',
                'slug' => 'chocolate-cakes',
                'created_at' => Carbon::now()
            ],
            [
                'id' => rand(0, 9999999),
                'thumbnail' => 'https://images.unsplash.com/photo-1571622840901-92ae138bd36e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80',
                'name' => 'Birthday Cakes',
                'slug' => 'birthday-cakes',
                'created_at' => Carbon::now()
            ],
            [
                'id' => rand(0, 9999999),
                'thumbnail' => 'https://images.unsplash.com/photo-1623428454614-abaf00244e52?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80',
                'name' => 'Wedding Cakes',
                'slug' => 'wedding-cakes',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => rand(0, 9999999),
                'thumbnail' => 'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80',
                'name' => 'Cup Cakes',
                'slug' => 'cup-cakes',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => rand(0, 9999999),
                'thumbnail' => 'https://images.unsplash.com/photo-1543512601-f0b56be2147e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTF8fGRvdWdobnV0c3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=720&q=60',
                'name' => 'Doughnuts',
                'slug' => 'doughnuts',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => rand(0, 9999999),
                'thumbnail' => 'https://images.unsplash.com/photo-1629324482344-58ac79e26b06?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80',
                'name' => 'Cookies',
                'slug' => 'cookies',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => rand(0, 9999999),
                'thumbnail' => 'https://images.unsplash.com/photo-1621303838226-5dc7130d5e19?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80',
                'name' => 'Red velvet cakes',
                'slug' => 'red-velvet-cakes',
                'created_at' => Carbon::now(),
            ]
        ]);
    }
}
