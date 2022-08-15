<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use \App\Models\User;
use \App\Models\Post;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => Str::random(10),
            'name' => $this->faker->name(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $post->authors()->sync(Arr::random(User::pluck('id')->toArray(), 2));
        });
    }
}
