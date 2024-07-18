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
                'user_id' => 2,
                'slug' => 'rice'
            ],
            [
                'category_name'    =>  'Tea',
                'user_id' => 2,
                'slug' => 'tea'
            ],
            [
                'category_name'    =>  'Mie',
                'user_id' => 2,
                'slug' => 'mie'
            ],
            [
                'category_name'    =>  'Coffe',
                'user_id' => 2,
                'slug' => 'coffe'
            ],
            [
                'category_name'    =>  'Milkbase',
                'user_id' => 2,
                'slug' => 'milkbase'
            ]
        ];
        Category::insert($data);
    }
}
