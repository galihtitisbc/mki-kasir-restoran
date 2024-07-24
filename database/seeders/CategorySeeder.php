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
        $data = [
            [
                'category_name'    =>  'Rice',
                'outlet_id' => 2,
                'slug' => 'rice'
            ],
            [
                'category_name'    =>  'Tea',
                'outlet_id' => 2,
                'slug' => 'tea'
            ],
            [
                'category_name'    =>  'Mie',
                'outlet_id' => 2,
                'slug' => 'mie'
            ],
            [
                'category_name'    =>  'Coffe',
                'outlet_id' => 2,
                'slug' => 'coffe'
            ],
            [
                'category_name'    =>  'Milkbase',
                'outlet_id' => 2,
                'slug' => 'milkbase'
            ]
        ];
        Category::insert($data);
    }
}
