<?php

use Illuminate\Database\Seeder;

class ProjectUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects_linked_users')->insert([
            [
                'project_id' => 1,
                'user_id' => 1,
            ],
        ]);
    }
}
