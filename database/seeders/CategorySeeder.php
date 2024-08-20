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
                'slug' => 'rice'
            ],
            [
                'category_name'    =>  'Tea',
                'slug' => 'tea'
            ],
            [
                'category_name'    =>  'Mie',
                'slug' => 'mie'
            ],
            [
                'category_name'    =>  'Coffe',
                'slug' => 'coffe'
            ],
            [
                'category_name'    =>  'Milkbase',
                'slug' => 'milkbase'
            ]
        ];
        Category::insert($data);
    }
}
