<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
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
        $datePart = now()->format('d/m/y'); // Format tanggal: 29/04/05
        $randomPart = rand(10, 99); // Angka acak 2 digit
        $slug = Str::slug($request->title) . '-' . str_replace('/', '', $datePart) . '-' . $randomPart;

        Post::create([
            'title' => $request->title,
            'label' => $request->label,
            'slug' => $slug,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth()->user()->id
        ]);

        return redirect()->route('dashboard.posts')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('Dashboard.Posts.edit',  [
            'title' => 'Posts',
            'post' => $post,
        ]);
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

    public function deleted(Request $request)
    {
        $search = $request->input('search');
        $deletedPosts = Post::onlyTrashed()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->get();
        return view('Dashboard.Posts.trash', compact('deletedPosts'));
    }

    public function restore($slug)
    {
        $post = Post::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $post->restore();
        return redirect()->route('dashboard.posts.deleted')->with('success', 'Post berhasil dipulihkan.');
    }

    public function forceDelete($slug)
    {
        $post = Post::onlyTrashed()->where('slug', $slug)->firstOrFail();

        if ($post->image) {
            Storage::delete($post->image);
        }

        $post->forceDelete();
        return redirect()->route('dashboard.posts.deleted')->with('success', 'Post berhasil dihapus permanen.');
    }


    public function restoreAll()
    {
        if (Post::onlyTrashed()->count() == 0) {
            return redirect()->route('dashboard.posts.deleted')->with('error', 'Tidak ada post yang dapat dipulihkan.');
        } else {
            Post::onlyTrashed()->restore();
            return redirect()->route('dashboard.posts.deleted')->with('success', 'Semua post berhasil dipulihkan.');
        }
    }

    public function forceDeleteAll()
    {
        Log::info('forceDeleteAll route is being accessed');
        $posts = Post::onlyTrashed()->get();
        foreach ($posts as $post) {
            if ($post->image && Storage::exists($post->image)) {
                Storage::delete($post->image);
            }
            $post->forceDelete();
        }

        return redirect()->route('dashboard.posts.deleted')->with('success', 'Semua post berhasil dihapus permanen.');
    }
}
