<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'id' => Uuid::generate()->string,
                'name' => 'Computers & Tablets',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Smartphones & Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Televisions',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Audio & Home Theater',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Cameras & Camcorders',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
