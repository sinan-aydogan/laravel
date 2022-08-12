<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Models/Post/IndexPage", [
            'header' => "Yazılar",
            'postList' => Post::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Models/Post/CreatePage", [
            'header' => "Yeni Yazı Ekle",
            'userList' => User::all(['id', 'name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->code = Str::random(5);
        $post->name = $request->name;
        $post->summary = $request->summary;
        $post->user_id = $request->user_id;
        $post->status = $request->status;
        $post->save();

        $post->authors()->attach(User::find($post->user_id));

        session()->flash('message', ['type'=>'success', 'content'=>'Yazı başarıyla eklendi']);

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return Inertia::render("Models/Post/ShowPage", [
            'header' => $post->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render("Models/Post/EditPage", [
            'header' => $post->name
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        session()->flash('message', ['type'=>'success', 'content'=>'Yazı düzenlendi eklendi']);

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('message', ['type'=>'danger', 'content'=>'Yazı silindi']);

        return redirect()->route('post.index');
    }
}
