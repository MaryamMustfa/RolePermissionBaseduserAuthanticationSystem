<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        

        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'admin']);
        }

        $permissions = Permission::pluck('id');

        if ($permissions && $permissions->count() > 0) {
            $adminRole->syncPermissions($permissions);

            echo "All permissions are assigned to the admin role.\n";
        } else {
            echo "No permissions found.\n";
        }
    }
}
