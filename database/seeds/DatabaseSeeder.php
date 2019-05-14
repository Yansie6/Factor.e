<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** -----------------------------------------------
     * Run
     * - Run the database seeds:
     *  - UsersSeeder
     *  - CompanySeeder
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            CompanySeeder::class
        ]);

        factory(App\User::class, 10)->create();
        factory(App\Company::class, 10)->create();
    }
}
