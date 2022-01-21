<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check = DB::table('users')->where('role', 1)->first();
        if (!$check) {
            DB::table('users')->insert(
                [
                    [
                        'first_name' => "Admin",
                        "last_name" => 'Admin',
                        "created_by" => Carbon::now(),
                        "role" => 1,
                        "email" => 'admin@gmail.com',
                        "password" => Hash::make('Admin@123'),
                    ]
                ]
            );
        }
    }
}
