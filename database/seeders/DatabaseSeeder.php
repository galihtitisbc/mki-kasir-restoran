<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bahan;
use App\Models\Category;
use App\Models\Outlet;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\SalesHistory;
use App\Models\Tax;
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
        Bahan::factory(10)->create();
        $bahan = Bahan::all();
        Outlet::each(function ($outlet) use ($bahan) {
            $outlet->bahans()->attach($bahan->random(rand(1, 10))->pluck('bahan_id')->toArray());
        });
        Product::factory(20)->create();
        Product::each(function ($product) use ($bahan) {
            $pivotArray = [];
            $bahanIds = $bahan->random(rand(1, 10))->pluck('bahan_id')->toArray();
            foreach ($bahanIds as $bahanId) {
                $pivotArray[] = ['bahan_id' => $bahanId, 'qty' => rand(1, 10), 'satuan_bahan' => fake()->randomElement(['Liter', 'Kg', 'gr'])];
            }
            $product->bahans()->attach($pivotArray);
        });
        $category = Category::all();
        Product::each(function ($product) use ($category) {
            $product->categories()->attach($category->random(rand(1, 5))->pluck('category_id')->toArray());
        });
        $outlet = Outlet::all();
        Product::each(function ($product) use ($outlet) {
            $product->outlets()->attach($outlet->random(rand(1, 5))->pluck('outlet_id')->toArray());
        });
        Category::each(function ($category) use ($outlet) {
            $category->outlet()->attach($outlet->random(rand(1, 5))->pluck('outlet_id')->toArray());
        });
        Pesanan::factory(20)->create();
        SalesHistory::factory(20)->create();
        $tax = Tax::all();
        SalesHistory::each(function ($salesHistory) use ($tax) {
            $pivotArray = [];
            $taxIds = $tax->random(rand(1, 3))->pluck('tax_id')->toArray();
            foreach ($taxIds as $taxId) {
                $pivotArray[] = ['tax_id' => $taxId, 'total' => $salesHistory->total_price * $tax[$taxId - 1]->tax_rate / 100];
            }
            $salesHistory->taxs()->attach($pivotArray);
        });
        $pesanan = Pesanan::all();
        Product::each(function ($product) use ($pesanan) {
            $pivotArray = [];
            $pesananIds = $pesanan->random(rand(1, 20))->pluck('pesanan_id')->toArray();
            $randTotal = rand(1, 15);
            foreach ($pesananIds as $pesananId) {
                $pivotArray[] = [
                    'pesanan_id' => $pesananId,
                    'product_id' => $product->product_id,
                    'qty' => $randTotal,
                    'harga' => $product->price,
                    'total' => $product->price * $randTotal
                ];
            }
            $product->pesanans()->attach($pivotArray);
        });
    }
}
