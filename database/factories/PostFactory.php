<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use \App\Models\User;
use \App\Models\Post;

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
            'user_id' => User::all()->random()->id
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $post->authors()->attach(User::all()->random()->id);
        });
    }
}
