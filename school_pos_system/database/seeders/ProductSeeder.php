<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        
        $products = [
            // Food & Beverages
            [
                'name' => 'Chicken Sandwich',
                'description' => 'Grilled chicken sandwich with lettuce and tomato',
                'sku' => 'FOOD-001',
                'barcode' => '1234567890123',
                'category_id' => $categories->where('name', 'Food & Beverages')->first()->id,
                'price' => 4.50,
                'cost' => 2.25,
                'stock_quantity' => 50,
                'min_stock_level' => 10,
                'is_active' => true,
                'track_quantity' => true
            ],
            [
                'name' => 'Orange Juice',
                'description' => 'Fresh orange juice 500ml',
                'sku' => 'FOOD-002',
                'barcode' => '1234567890124',
                'category_id' => $categories->where('name', 'Food & Beverages')->first()->id,
                'price' => 2.00,
                'cost' => 1.00,
                'stock_quantity' => 100,
                'min_stock_level' => 20,
                'is_active' => true,
                'track_quantity' => true
            ],
            [
                'name' => 'Chocolate Chip Cookie',
                'description' => 'Homemade chocolate chip cookie',
                'sku' => 'FOOD-003',
                'barcode' => '1234567890125',
                'category_id' => $categories->where('name', 'Food & Beverages')->first()->id,
                'price' => 1.50,
                'cost' => 0.75,
                'stock_quantity' => 80,
                'min_stock_level' => 15,
                'is_active' => true,
                'track_quantity' => true
            ],
            
            // School Supplies
            [
                'name' => 'Spiral Notebook',
                'description' => 'A4 spiral notebook with 100 pages',
                'sku' => 'SUPPLY-001',
                'barcode' => '1234567890126',
                'category_id' => $categories->where('name', 'School Supplies')->first()->id,
                'price' => 3.25,
                'cost' => 1.50,
                'stock_quantity' => 200,
                'min_stock_level' => 30,
                'is_active' => true,
                'track_quantity' => true
            ],
            [
                'name' => 'Blue Pen',
                'description' => 'Ballpoint pen with blue ink',
                'sku' => 'SUPPLY-002',
                'barcode' => '1234567890127',
                'category_id' => $categories->where('name', 'School Supplies')->first()->id,
                'price' => 0.75,
                'cost' => 0.25,
                'stock_quantity' => 500,
                'min_stock_level' => 50,
                'is_active' => true,
                'track_quantity' => true
            ],
            [
                'name' => 'Pencil Set',
                'description' => 'Pack of 12 HB pencils',
                'sku' => 'SUPPLY-003',
                'barcode' => '1234567890128',
                'category_id' => $categories->where('name', 'School Supplies')->first()->id,
                'price' => 5.00,
                'cost' => 2.50,
                'stock_quantity' => 150,
                'min_stock_level' => 25,
                'is_active' => true,
                'track_quantity' => true
            ],
            
            // Uniforms
            [
                'name' => 'School Polo Shirt',
                'description' => 'Navy blue polo shirt with school logo',
                'sku' => 'UNIFORM-001',
                'barcode' => '1234567890129',
                'category_id' => $categories->where('name', 'Uniforms')->first()->id,
                'price' => 18.00,
                'cost' => 9.00,
                'stock_quantity' => 75,
                'min_stock_level' => 10,
                'is_active' => true,
                'track_quantity' => true
            ],
            [
                'name' => 'School Tie',
                'description' => 'School tie with official colors',
                'sku' => 'UNIFORM-002',
                'barcode' => '1234567890130',
                'category_id' => $categories->where('name', 'Uniforms')->first()->id,
                'price' => 12.00,
                'cost' => 6.00,
                'stock_quantity' => 40,
                'min_stock_level' => 8,
                'is_active' => true,
                'track_quantity' => true
            ],
            
            // Books
            [
                'name' => 'Mathematics Textbook',
                'description' => 'Grade 10 Mathematics textbook',
                'sku' => 'BOOK-001',
                'barcode' => '1234567890131',
                'category_id' => $categories->where('name', 'Books')->first()->id,
                'price' => 45.00,
                'cost' => 22.50,
                'stock_quantity' => 60,
                'min_stock_level' => 5,
                'is_active' => true,
                'track_quantity' => true
            ],
            [
                'name' => 'English Literature Book',
                'description' => 'Grade 9 English Literature anthology',
                'sku' => 'BOOK-002',
                'barcode' => '1234567890132',
                'category_id' => $categories->where('name', 'Books')->first()->id,
                'price' => 35.00,
                'cost' => 17.50,
                'stock_quantity' => 45,
                'min_stock_level' => 5,
                'is_active' => true,
                'track_quantity' => true
            ],
            
            // Sports Equipment
            [
                'name' => 'Soccer Ball',
                'description' => 'Official size soccer ball',
                'sku' => 'SPORT-001',
                'barcode' => '1234567890133',
                'category_id' => $categories->where('name', 'Sports Equipment')->first()->id,
                'price' => 25.00,
                'cost' => 12.50,
                'stock_quantity' => 20,
                'min_stock_level' => 3,
                'is_active' => true,
                'track_quantity' => true
            ],
            
            // Electronics
            [
                'name' => 'Scientific Calculator',
                'description' => 'Casio scientific calculator',
                'sku' => 'ELECT-001',
                'barcode' => '1234567890134',
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'price' => 35.00,
                'cost' => 17.50,
                'stock_quantity' => 30,
                'min_stock_level' => 5,
                'is_active' => true,
                'track_quantity' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
