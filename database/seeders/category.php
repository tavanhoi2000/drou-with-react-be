<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class category extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['title' => 'Iphone', 'image' => "1"],
            ['title' => 'Mini Speaker', 'image' => "1"],
            ['title' => 'Tablets', 'image' => "1"],
            ['title' => 'Headphones', 'image' => "1"],
            ['title' => 'Laptop', 'image' => "1"],
            ['title' => 'Accesories', 'image' => "1"]
        ]);
    }
}
