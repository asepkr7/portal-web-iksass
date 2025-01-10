<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $showEntries = $request->input('show_entries', 10);

        $posts = Post::with('user') // Eager load relasi user
            ->latest()
            ->filter(request(['search']))
            ->paginate($showEntries)
            ->withQueryString();

        foreach ($posts as $post) {
            // Mengambil isi konten tanpa tag HTML
            $post->content = strip_tags($post->content);
        }

        return view('Home.News.index', [
            'title' => 'Posts',
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
        return view('Home.News.show', [
            'post' => $post
        ]);
    }
}