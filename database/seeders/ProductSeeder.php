<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Webpatser\Uuid\Uuid;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::select('id')
            ->whereNull('deleted_at')
            ->take(5)
            ->get()
            ->toArray();

        Product::insert([
            [
                'id' => Uuid::generate()->string,
                'name' => 'Apple iPhone 13 Pro',
                'price' => 999,
                'category_id' => $categories[0]['id'],
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Samsung Galaxy S21 Ultra',
                'price' => 1199,
                'category_id' => $categories[0]['id'],
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Sony WH-1000XM4 Wireless Headphones',
                'price' => 349,
                'category_id' => $categories[0]['id'],
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => "Levi's 501 Original Fit Jeans",
                'price' => 69,
                'category_id' => $categories[1]['id'],
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Nike Air Max 270',
                'price' => 150,
                'category_id' => $categories[1]['id'],
                'stock' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => "Calvin Klein Women's Cotton Underwear",
                'price' => 25,
                'category_id' => $categories[1]['id'],
                'stock' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Instant Pot Duo 7-in-1 Electric Pressure Cooker',
                'price' => 99,
                'category_id' => $categories[2]['id'],
                'stock' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'KitchenAid Classic Series 4.5-Qt Stand Mixer',
                'price' => 299,
                'category_id' => $categories[2]['id'],
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Shark Navigator Lift-Away Professional Vacuum',
                'price' => 199,
                'category_id' => $categories[2]['id'],
                'stock' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'CeraVe Moisturizing Cream',
                'price' => 15,
                'category_id' => $categories[3]['id'],
                'stock' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Neutrogena Hydro Boost Water Gel',
                'price' => 20,
                'category_id' => $categories[3]['id'],
                'stock' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Philips Sonicare Electric Toothbrush',
                'price' => 100,
                'category_id' => $categories[3]['id'],
                'stock' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Fitbit Charge 5 Advanced Fitness & Health Tracker',
                'price' => 179,
                'category_id' => $categories[4]['id'],
                'stock' => 55,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Coleman Sundome 4-Person Tent',
                'price' => 129,
                'category_id' => $categories[4]['id'],
                'stock' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Yeti Rambler 30 oz Tumbler',
                'price' => 39,
                'category_id' => $categories[4]['id'],
                'stock' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
