<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UserOutlet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'outlet_id' => 2
            ],
            [
                'user_id'   => 5,
                'outlet_id' => 1
            ],
            [
                'user_id'   => 6,
                'outlet_id' => 1
            ],
            [
                'user_id'   => 7,
                'outlet_id' => 1
            ],
            [
                'user_id'   => 2,
                'outlet_id' => 1
            ],
            [
                'user_id'   => 2,
                'outlet_id' => 2
            ],
            [
                'user_id'   => 2,
                'outlet_id' => 3
            ],
            [
                'user_id'   => 2,
                'outlet_id' => 4
            ],
            [
                'user_id'   => 2,
                'outlet_id' => 5
            ]
        ];
        $taxOutlet = [
            [
                'tax_id'    =>  1,
                'outlet_id' => 2
            ],
            [
                'tax_id'    =>  2,
                'outlet_id' => 2
            ],
            [
                'tax_id'    =>  3,
                'outlet_id' => 1
            ]
        ];
        $supplierOutlet = [
            [
                'supplier_id' => 1,
                'outlet_id' => 1
            ],
            [
                'supplier_id' => 2,
                'outlet_id' => 2
            ],
            [
                'supplier_id' => 3,
                'outlet_id' => 2
            ]
        ];
        DB::table('supplier_outlets')->insert($supplierOutlet);
        UserOutlet::insert($userOutlet);
        DB::table('tax_outlets')->insert($taxOutlet);
    }
}
