<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('roles')->truncate(); 

        //create roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);
        $customer = Role::create(['name' => 'customer']);

        DB::table('role_has_permissions')->truncate(); 
        // Assign permissions
        $admin->givePermissionTo(Permission::all());
        $user->givePermissionTo(['product-create','product-edit']);
        $customer->givePermissionTo([]);

        DB::statement("SET foreign_key_checks = 1");
    }
}
