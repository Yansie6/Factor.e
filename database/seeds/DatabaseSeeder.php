<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** -----------------------------------------------
     * Run
     * - Run the database seeds:
     *  - UsersSeeder
     *  - CompanySeeder
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            CompanySeeder::class
        ]);

        $user = factory(App\User::class, 50)->make();
        //$company = factory(App\Company::class, 50)->make();

        /*factory(App\User::class, 50)->create()->each(function ($user) {
            $user->posts()->save(factory(App\Post::class)->make());
        });
        factory(App\Company::class, 50)->create()->each(function ($company) {
            $company->posts()->save(factory(App\Post::class)->make());
        });*/
    }
}
