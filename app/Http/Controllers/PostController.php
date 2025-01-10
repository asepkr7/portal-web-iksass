<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $showEntries = $request->input('show_entries', 10);
        $posts = Post::latest()->orderBy('created_at')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();

        foreach ($posts as $post) {
            // Mengambil isi konten tanpa tag HTML
            $post->content = strip_tags($post->content);
        }

        return view('Dashboard.Posts.index', [
            'title' => 'Posts',
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('Dashboard.Posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'label' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg|max:5120'
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('posts', 'public') : null;

        Post::create([
            'title' => $request->title,
            'label' => $request->label,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth()->user()->id
        ]);

        return redirect()->route('dashboard.posts')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('Dashboard.Posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'label' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg|max:5120'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::delete($post->image);
            }

            // Proses upload image dan simpan path
            $imagePath = $request->file('image')->store('posts', 'public');

            $post->update([
                'title' => $request->title,
                'label' => $request->label,
                'content' => $request->content,
                'image' => $imagePath,  // Simpan path gambar
            ]);
        } else {
            // Jika tidak ada gambar baru, cukup update data lainnya
            $post->update([
                'title' => $request->title,
                'label' => $request->label,
                'content' => $request->content,
            ]);
        }

        return redirect()->route('dashboard.posts')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::delete($post->image);
        }
        $post->delete();
        return redirect()->route('dashboard.posts')->with('success', 'Post deleted successfully.');
    }
}