<?php

namespace Database\Seeders;

use App\Models\NewsItem;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory(10)->create();

        NewsItem::factory(30, ['published' => true])->afterCreating(function (NewsItem $newsItem) use ($tags) {
            $newsItem->tags()->attach($tags->random(rand(1, 3)));
        })->create();
    }
}
