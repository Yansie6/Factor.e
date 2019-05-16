<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->insert([
            [
                'project_id' => 1,
                'title' => "Gebruiker doet iets geks",
                'content' => "Wanneer de gebruiker op een knop klikt loopt de computer vast.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
