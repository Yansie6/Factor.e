<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /** ----------------------------------------------------
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'firstname' => "Yan",
                'lastname' => "Siegers",
                'email' => "yan.siegers@yansiegers.nl",
                'password' => bcrypt('test123'),
                'rank' => 1,
                'company_id' => 0
            ],
            [
                'firstname' => "Voornaam",
                'lastname' => "Achternaam",
                'email' => "test@test.nl",
                'password' => bcrypt('test123'),
                'rank' => 1,
                'company_id' => 0
            ],
        ]);
    }
}
