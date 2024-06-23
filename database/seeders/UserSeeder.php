<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $customerRole = Role::where('name', 'customer')->first();

        User::create([
            'uuid' => Str::uuid(),
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'uuid' => Str::uuid(),
            'email' => 'albi@gmail.com',
            'name' => 'Albi Nur Yachya Muslim',
            'password' => bcrypt('password'),
            'role_id' => $customerRole->id,
        ]);
    }
}