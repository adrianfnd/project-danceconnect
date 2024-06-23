<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'admin', 'description' => 'role administrator'],
            ['name' => 'customer', 'description' => 'role customer'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
