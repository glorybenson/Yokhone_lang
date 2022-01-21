<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('roles')->insert(
            [
                [
                    "name" => "Admin",
                    "routes" => '["All"]',
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name" => "User",
                    "routes" => '["create-user"]',
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    'name' => "Client",
                    "routes" => '["create-client"]',
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name" => "Farm",
                    "routes" => '["create-farm"]',
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    'name' => "Employee",
                    "routes" => '["create-employee"]',
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name" => "Finance",
                    "routes" => '["create-finance"]',
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
            ]
        );
    }
}
