<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Post;
use \App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Post 1
        $post = new Post;
        $post->name = "Ankara'nın taşına bak";
        $post->code= "ANK";
        $post->user_id = 1;
        $post->save();

        // Post 2
        $post2 = Post::create([
            "code" => "IZM",
            "name" => "İzmir'de gün batımı",
            "user_id" => 3
        ]);

        // Relation
        $post->authors()->attach(User::find($post->user_id));
        $post2->authors()->attach(User::find($post2->user_id));
    }
}
