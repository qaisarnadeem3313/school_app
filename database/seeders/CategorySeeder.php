<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Food & Beverages',
                'description' => 'Cafeteria items, snacks, and drinks',
                'color' => '#28a745',
                'is_active' => true
            ],
            [
                'name' => 'School Supplies',
                'description' => 'Stationery, notebooks, and writing materials',
                'color' => '#007bff',
                'is_active' => true
            ],
            [
                'name' => 'Uniforms',
                'description' => 'School uniforms and accessories',
                'color' => '#6c757d',
                'is_active' => true
            ],
            [
                'name' => 'Books',
                'description' => 'Textbooks and educational materials',
                'color' => '#ffc107',
                'is_active' => true
            ],
            [
                'name' => 'Sports Equipment',
                'description' => 'Sports gear and equipment',
                'color' => '#dc3545',
                'is_active' => true
            ],
            [
                'name' => 'Electronics',
                'description' => 'Calculators, tablets, and electronic devices',
                'color' => '#17a2b8',
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
