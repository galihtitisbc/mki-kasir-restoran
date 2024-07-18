<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            CategorySeeder::class,
            SupplierSeeder::class,
            OutletSeeder::class,
            TaxSeeder::class,
            MejaSeeder::class
        ]);
    }
}
