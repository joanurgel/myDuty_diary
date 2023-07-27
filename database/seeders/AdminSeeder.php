<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if an admin already exists in the database
        $adminExists = DB::table('users')->where('email', 'admin@example.com')->exists();

        // If an admin doesn't exist, insert it into the users table
        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('adminpassword'),
                'role' => 1, // Set the role for the admin user (1 for admin, 2 for supervisor, etc.)
            ]);
        }
    }
}
