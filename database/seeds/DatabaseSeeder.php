<?php

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
            CompaniesTableSeeder::class,
            NotesTableSeeder::class,
            ProjectsTableSeeder::class,
            ProjectTagsTableSeeder::class,
            ProjectUsersTableSeeder::class,
            TagsTableSeeder::class,
            UsersTableSeeder::class,
            VideoNotesTableSeeder::class,
            VideosTableSeeder::class,
            VideoTagsTableSeeder::class,
        ]);

        $factor = 10;

        factory(App\Company::class, $factor)->create();
        factory(App\Note::class, $factor)->create();
        factory(App\Project::class, $factor)->create();
        //factory(App\Project_linked_tag::class, $factor * 5)->create();
        factory(App\Project_linked_user::class, $factor * 5)->create();
        factory(App\Tag::class, $factor)->create();
        factory(App\User::class, $factor)->create();
        factory(App\Video_note::class, $factor * 5)->create();
        factory(App\Video::class, $factor)->create();
        //factory(App\Video_linked_tag::class, $factor * 5)->create();
    }
}
