<?php

use App\Company;
use App\Video;
use App\Video_note;
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
            VideoNotesTableSeeder::class,
            CompaniesTableSeeder::class
        ]);

        $factor = 10;

        factory(App\User::class, $factor)->create();
        factory(App\Video::class, $factor)->create();
        factory(App\Video_note::class, $factor * 5)->create();
        factory(App\Company::class, $factor)->create();

    }
}
