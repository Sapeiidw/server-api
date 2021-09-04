<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => Hash::make('password'),
            ],
        ]);
        User::find(1)->assignRole('user');
        User::find(2)->assignRole('admin');
        User::find(3)->assignRole('super-admin');
    }
}