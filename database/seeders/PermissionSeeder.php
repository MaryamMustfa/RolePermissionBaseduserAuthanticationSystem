<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAccess = Permission::create(['name' => 'Role access']);
        $roleEdit = Permission::create(['name' => 'Role edit']);
        $roleCreate = Permission::create(['name' => 'Role create']);
        $roleDelete = Permission::create(['name' => 'Role delete']);

        $userAccess = Permission::create(['name' => 'User access']);
        $userEdit = Permission::create(['name' => 'User edit']);
        $userCreate = Permission::create(['name' => 'User create']);
        $userDelete = Permission::create(['name' => 'User delete']);

        $permissionAccess = Permission::create(['name' => 'Permission access']);
        $permissionEdit = Permission::create(['name' => 'Permission edit']);
        $permissionCreate = Permission::create(['name' => 'Permission create']);
        $permissionDelete = Permission::create(['name' => 'Permission delete']);
    }
}
