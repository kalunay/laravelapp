<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

class PostsController extends Controller
{
    public function index()
    {

        $posts = Post::all();
        return view('post.index', compact('posts'));

    }

    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    public function store(){
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'category_id' => '',
        ]);
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'category_id' => '',
        ]);
        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    public function delete()
    {
        //$post = Post::find(1);
        //$post->delete();

        $post = Post::withTrashed()->find(1);
        $post->restore();
    }

    public function firstOrCreate()
    {
        $post = Post::firstOrCreate([
            'title' => 'title 2',
        ],[
            'title' => 'title 2',
            'content' => 'content 2',
            'image' => '',
            'likes' => 13,
            'is_published' => 0,
        ]);

        dump($post->title);

        $post = Post::firstOrCreate([
            'title' => 'title 21',
        ],[
            'title' => 'title 21',
            'content' => 'content 2',
            'image' => '',
            'likes' => 13,
            'is_published' => 0,
        ]);
        dump($post->title);
    }

    public function updateOrCreate()
    {
        $post = Post::updateOrCreate([
            'title' => 'title 2',
        ],[
            'title' => 'title 2',
            'content' => 'content content content content 2',
            'image' => '',
            'likes' => 13,
            'is_published' => 0,
        ]);

        dump($post->content);

        $post = Post::updateOrCreate([
            'title' => 'title 22',
        ],[
            'title' => 'title 21',
            'content' => 'content 2',
            'image' => '',
            'likes' => 13,
            'is_published' => 0,
        ]);
        dump($post->title);
    }
}
