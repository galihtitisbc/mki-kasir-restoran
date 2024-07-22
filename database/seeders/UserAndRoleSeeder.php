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
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), 'remember_token' => Str::random(10)
        ]);
        $supervisor = User::create([
            'name' => 'boss',
            'username' => 'supervisor',
            'email' => 'bos@gmail.com',
            'phone' => '123123304',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), 'remember_token' => Str::random(10)
        ]);
        $supervisor2 = User::create([
            'name' => 'boss2',
            'username' => 'supervisor2',
            'email' => '2@gmail.com',
            'phone' => '123104',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), 'remember_token' => Str::random(10)
        ]);
        $kasir = User::create([
            'name' => 'kasir',
            'username' => 'kasir',
            'email' => 'kasir@gmail.com',
            'phone' => '2312334',
            'supervisor_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), 'remember_token' => Str::random(10)
        ]);
        $dapur = User::create([
            'name' => 'dapur',
            'username' => 'dapur',
            'email' => 'dapur@gmail.com',
            'phone' => '1312334',
            'supervisor_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'remember_token' => Str::random(10),
        ]);
        $superadminRole = Role::create(['name' => 'SUPERADMIN']);
        $supervisorRole = Role::create(['name' => 'SUPERVISOR']);
        $kasirRole = Role::create(['name' => 'KASIR']);
        $dapurRole = Role::create(['name' => 'DAPUR']);

        //assign role
        $superadmin->assignRole($superadminRole);
        $supervisor->assignRole($supervisorRole);
        $supervisor2->assignRole($supervisorRole);
        $kasir->assignRole($kasirRole);
        $dapur->assignRole($dapurRole);
    }
}
