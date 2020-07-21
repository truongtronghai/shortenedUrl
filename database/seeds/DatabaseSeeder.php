<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'System administrator',
            'email' => 'admin@rut.xyz',
            'email_verified_at' => now(),
            'password' => Hash::make('1234567890'),
            'remember_token' => null,
            'role' => 0,
            'apis'=>0,
        ]);

        DB::table('users')->insert([
            'name' => 'Anonymous',
            'email' => 'anonymous@rut.xyz',
            'email_verified_at' => now(),
            'password' => Hash::make('1234567890'),
            'remember_token' => null,
            'role' => 1,
            'apis'=>0,
        ]);

        $this->call(UrlsSeeder::class);
    }
}
