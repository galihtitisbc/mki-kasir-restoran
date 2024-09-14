<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'phone' => '123134',
            'is_active' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'remember_token' => Str::random(10)
        ]);
        $supervisor = User::create([
            'name' => 'boss',
            'username' => 'supervisor',
            'email' => 'bos@gmail.com',
            'phone' => '123123304',
            'is_active' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'remember_token' => Str::random(10)
        ]);
        $supervisor2 = User::create([
            'name' => 'boss2',
            'username' => 'supervisor2',
            'email' => '2@gmail.com',
            'phone' => '123104',
            'is_active' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'remember_token' => Str::random(10)
        ]);
        $admin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'supervisor_id' => 2,
            'email' => 'admin@gmail.com',
            'phone' => '1231774',
            'is_active' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'remember_token' => Str::random(10)
        ]);
        $kasir = User::create([
            'name' => 'kasir',
            'username' => 'kasir',
            'email' => 'kasir@gmail.com',
            'phone' => '2312334',
            'supervisor_id' => 2,
            'is_active' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'remember_token' => Str::random(10)
        ]);
        $kasir2 = User::create([
            'name' => 'kasir2',
            'username' => 'kasir2',
            'email' => 'kasir2@gmail.com',
            'phone' => '2312',
            'is_active' => true,
            'supervisor_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'remember_token' => Str::random(10)
        ]);
        $dapur = User::create([
            'name' => 'dapur',
            'username' => 'dapur',
            'email' => 'dapur@gmail.com',
            'phone' => '1312334',
            'supervisor_id' => 2,
            'is_active' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'remember_token' => Str::random(10),
        ]);
        $superadminRole = Role::create(['name' => 'SUPERADMIN']);
        $supervisorRole = Role::create(['name' => 'SUPERVISOR']);
        $adminRole = Role::create(['name' => 'ADMIN']);
        $kasirRole = Role::create(['name' => 'KASIR']);
        $dapurRole = Role::create(['name' => 'DAPUR']);

        //assign role
        $superadmin->assignRole($superadminRole);
        $supervisor->assignRole($supervisorRole);
        $supervisor2->assignRole($supervisorRole);
        $admin->assignRole($adminRole);
        $kasir->assignRole($kasirRole);
        $kasir2->assignRole($kasirRole);
        $dapur->assignRole($dapurRole);
    }
}
