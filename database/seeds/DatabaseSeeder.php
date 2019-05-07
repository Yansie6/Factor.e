<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** -----------------------------------------------
     * Run
     * - Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
    }
}
