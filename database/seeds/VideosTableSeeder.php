<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            [
                'project_id' => rand(1, 10),
                'name' => "boekemantsjes.mp4",
                'test_person' => "Renze Dijkstra",
                'link' => "https://www.youtube.com/watch?v=gAjR4_CbPpQ",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
