<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('admin');
        $admin->role_id = 1; // Assuming the 'admin' role has an ID of 1
        $admin->assignRole('admin');
        $admin->save();


    }
}
