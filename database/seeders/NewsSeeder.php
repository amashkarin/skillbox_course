<?php

namespace Database\Seeders;

use App\Models\NewsItem;
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
        NewsItem::factory(30, ['published' => true])->create();
    }
}
