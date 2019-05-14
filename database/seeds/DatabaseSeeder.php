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

        factory(App\User::class, 10)->create();
        factory(App\Video::class, 10)->create();
        factory(App\Video_note::class, 10)->create();
        factory(App\Company::class, 10)->create();

    }
}
