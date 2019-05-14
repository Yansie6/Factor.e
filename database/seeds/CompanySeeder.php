<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
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
                'email' => "nhlstenden@example.com"
            ],
        ]);
    }
}
