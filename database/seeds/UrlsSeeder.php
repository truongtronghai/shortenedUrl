<?php

use Illuminate\Database\Seeder;

class UrlsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Url::class, 100)->create();
        factory(App\User::class, 20)->create();
    }
}
