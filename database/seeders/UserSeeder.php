<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'first_name' => "Admin",
                    "last_name" => 'Admin',
                    "created_by" => null,
                    "role" => 1,
                    "email" => 'admin@gmail.com',
                    "password" => 'Admin@123',
                ]
            ]
        );
    }
}
