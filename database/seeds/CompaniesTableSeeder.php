<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name' => "NHL Stenden",
                'address' => "Rengerslaan 10, 8917 DD, Leeuwarden",
                'phone' => "+31 (0)88 991 7000",
                'email' => "nhlstenden@example.com",
                'image' => "https://www.nhlstenden.com/sites/default/files/styles/overview_images/public/diversen/locaties/nhl_stenden_plein.jpg?itok=TZ6LNp4h&c=e55e9a252fc61f708278e02d97d083f3&time=1554365777",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
