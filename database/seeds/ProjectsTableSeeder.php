<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'company_id' => 1,
                'name' => "Factor Yeet",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
