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
        factory(App\User::class, 10)->create(); // phai goi cai nay truoc vi no se la Foreign Key cho URL. Neu dat phia sau se gay ra loi
        factory(App\Url::class, 100)->create();
    }
}
