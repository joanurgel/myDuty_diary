<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the roles you want to insert
        $roles = [
            ['name' => 'admin'],
            ['name' => 'supervisor'],
            ['name' => 'trainee'],
        ];

        // Insert the roles into the role table
        DB::table('roles')->insert($roles);
    }
}