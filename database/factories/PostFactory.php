<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arUserIds = User::select(['id'])->get()->pluck('id')->toArray();
        return [
            'slug' => $this->faker->unique()->slug(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->realText(),
            'body' => $this->faker->realText(),
            'published' => (bool)rand(0, 1),
            'owner_id' => $arUserIds[array_rand($arUserIds)],
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
//    public function unverified()
//    {
//        return $this->state(function (array $attributes) {
//            return [
//                'email_verified_at' => null,
//            ];
//        });
//    }
}
