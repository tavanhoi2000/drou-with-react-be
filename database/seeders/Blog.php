<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Blog extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->insert([
            ['title' => 'Music magnate headphones', 'description' => '1', 'sub_title' => '1','sub_description'=>'2', 'image' => '1', 'category_id' => '1'],
            ['title' => 'MacBook Air labore et dolore', 'description' => '1', 'sub_title' => '1','sub_description'=>'2', 'image' => '1', 'category_id' => '1'],
            ['title' => 'Ipsum available but the majority', 'description' => '1', 'sub_title' => '1','sub_description'=>'2', 'image' => '1', 'category_id' => '1'],
            ['title' => '2023 Newest Macbook Pro', 'description' => '1', 'sub_title' => '1','sub_description'=>'2', 'image' => '1', 'category_id' => '1'],
        ]);
    }
}
