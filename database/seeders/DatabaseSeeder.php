<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UserOutlet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserAndRoleSeeder::class,
            OutletSeeder::class,
            CategorySeeder::class,
            SupplierSeeder::class,
            TaxSeeder::class,
            MejaSeeder::class
        ]);
        $userOutlet = [
            [
                'user_id'   => 4,
                'outlet_id' => 1
            ],
            [
                'user_id'   => 5,
                'outlet_id' => 2
            ],
            [
                'user_id'   => 6,
                'outlet_id' => 2
            ],
            [
                'user_id'   => 5,
                'outlet_id' => 3
            ],
            [
                'user_id'   => 4,
                'outlet_id' => 2
            ]
        ];
        UserOutlet::insert($userOutlet);
    }
}
