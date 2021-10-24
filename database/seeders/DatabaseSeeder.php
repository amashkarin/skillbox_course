<?php

namespace Database\Seeders;

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
//        \App\Models\User::factory(3)->create();
//        \App\Models\Post::factory(21)->create();
        $this->call(AuthorsAndArticlesSeeder::class);
        $this->call(NewsSeeder::class);
    }
}
