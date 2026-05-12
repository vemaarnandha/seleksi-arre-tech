<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $post = post::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->paginate(5); 

        // hitung total post
        $postCount = $post->count();

        return view('postingan', compact('post', 'postCount'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_post' => 'required|string',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:10000', // nullable, bukan required
        ]);

        // Hanya proses jika ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Simpan gambar ke storage/app/public/images
            $validated['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        // Tambahkan user_id dari user yang login
        $validated['user_id'] = auth()->id();

        // Simpan ke database
        post::create($validated);

        return redirect()->route('home')->with('success', 'Post berhasil dibuat!');
    }

    public function edit($post_id)
    {
        // Pastikan hanya pemilik postingan yang bisa mengedit
        $post = post::findOrFail($post_id);
        // Cek apakah user yang sedang login adalah pemilik postingan
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        return view('postingan.edit', compact('post'));
    }

    public function update(Request $request, $post_id)
    {

        $post = post::findOrFail($post_id); // huruf P kapital (konvensi)

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'sometimes|file|mimes:jpeg,png,jpg,webp|max:10000', // nullable, bukan required
            'isi_post' => 'required|string',
        ]);

        // Hanya proses jika ada file baru yang diupload
        if ($request->hasFile('gambar')) {
            // Simpan gambar ke storage/app/public/images
            $validated['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        $post->update($validated);

        return redirect()->route('home')->with('success', 'Post berhasil diperbarui!');
    }

    public function destroy($post_id)
    {
        $post = post::findOrFail($post_id);
        $post->delete();

        return redirect()->back()->with('success', 'Post berhasil dihapus!');
    }
}
