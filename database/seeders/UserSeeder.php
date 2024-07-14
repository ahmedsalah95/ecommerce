<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $admin->addRole('Admin');

        $normalUser = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('password123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $normalUser->addRole('User');
    }
}
