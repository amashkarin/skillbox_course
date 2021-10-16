<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class AuthorsAndArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(2)->create();
        $tags = Tag::factory(10)->create();
        Post::factory(20)->afterMaking(function (Post $post) use ($users) {
            $post->owner_id = $users->random()->id;
        })->afterCreating(function (Post $post) use ($tags) {
            $post->tags()->attach($tags->random(rand(1, 3)));
        })->create();
    }
}
