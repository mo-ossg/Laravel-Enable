<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // *********** ADMIN *********** //

        // Role::create(['name' => 'Super_admin', 'guard_name' => 'admin']);
        Role::create(['name' => 'Content-Manger', 'guard_name' => 'admin']);
        Role::create(['name' => 'Human-Resources', 'guard_name' => 'admin']);

        // *********** BROKER *********** //
        Role::create(['name'       => 'Broker', 'guard_name' => 'broker']);
    }
}
