<?php

use Illuminate\Database\Seeder;

class VideoTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos_linked_tags')->insert([
            [
                'tag_id' => 1,
                'video_id' => 1,
            ],
        ]);
    }
}
