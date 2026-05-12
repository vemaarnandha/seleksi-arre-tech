<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class HomeController extends Controller
{
    public function index(Request $request)
    {   
        $sort = $request->input('sort', 'latest'); // Default sorting by latest
        $search = $request->input('search');
        $post = Post::where('judul', 'like', "%$search%");

        if ($sort === 'oldest') {
            $post = $post->oldest();
        } else {
            $post = $post->latest();
        }

        $post = $post->paginate(4)->withQueryString(); // Menjaga query string saat paginasi

        return view('home', compact('post', 'search', 'sort'));
    }

    public function show($post_id)
    {
        $post = Post::findOrFail($post_id);

        return view('postingan.show-post', compact('post'));
    }   
}
