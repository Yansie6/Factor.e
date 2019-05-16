<?php

use Illuminate\Database\Seeder;

class ProjectTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects_linked_tags')->insert([
            [
                'tag_id' => 1,
                'project_id' => 1,
            ],
        ]);
    }
}
