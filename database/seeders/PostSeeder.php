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
        $post->save();

        // Post 2
        $post2 = Post::create([
            "code" => "IZM",
            "name" => "İzmir'de gün batımı",
        ]);

        // Relation
        $post->authors()->sync([1,5,6]);
        $post2->authors()->sync([2,5,10]);
    }
}
