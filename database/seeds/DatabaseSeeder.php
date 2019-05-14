<?php

use App\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** -----------------------------------------------
     * Run
     * - Run the database seeds
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            VideosTableSeeder::class,
            CompaniesTableSeeder::class
        ]);

        factory(App\User::class, 10)->create();
        //factory(App\Video::class, 10)->create();
        factory(App\Company::class, 10)->create();

    }
}
