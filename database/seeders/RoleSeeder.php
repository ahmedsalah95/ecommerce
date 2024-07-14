<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Roles =[
            [
                'name'=>'Admin',
                'display_name'=>'Admin',
                'description'=>'Admin that can control everything',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'=>'User',
                'display_name'=>'User',
                'description'=>'User is just a normal user on in the system',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]

        ];

        Role::insert($Roles);
    }
}
