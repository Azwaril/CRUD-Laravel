<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TblPostController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        // Ambil semua data posts dari tabel
        $posts = DB::table('tbl_posts')->get();

        // Kirim data posts ke view 'posts.index'
        return view('posts.index', compact('posts'));
    }

    // Tampilkan form untuk menambah post
    public function create()
    {
        return view('posts.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari form
        $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Gambar opsional
        ]);

        // Gambar default jika tidak ada gambar yang diupload
        $imagePath = 'Noimage.jpg';

        // Jika ada file gambar, simpan di folder 'images' di storage public
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Insert data post baru ke dalam database
        DB::table('tbl_posts')->insert([
            'title' => $request->title,
            'slug' => \Str::slug($request->title), // Membuat slug dari judul
            'user_id' => auth()->id() ?? 1, // ID user, jika tidak ada gunakan 1
            'content' => $request->content,
            'image' => $imagePath,
            'hits' => 0, // Hit awal
            'aktif' => 'Y', // Status aktif
            'status' => 'publish', // Status publish
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    // Tampilkan form untuk edit post
    public function edit($id)
    {
        // Ambil post berdasarkan ID
        $post = DB::table('tbl_posts')->where('id', $id)->first();

        // Jika post tidak ditemukan, redirect dengan pesan error
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found');
        }

        // Kirim data post ke view edit
        return view('posts.edit', compact('post'));
    }

    // Update data post
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:tbl_posts,slug,' . $id,
            'user_id' => 'required|integer',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Ambil data post berdasarkan ID
        $post = DB::table('tbl_posts')->where('id', $id)->first();
    
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }
    
        // Proses gambar baru jika ada
        $imagePath = $post->image; // Gambar lama
        if ($request->hasFile('image')) {
            if ($imagePath !== 'Noimage.jpg') {
                Storage::disk('public')->delete($imagePath); // Hapus gambar lama jika bukan default
            }
            $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar baru
        }
    
        // Update data di database
        DB::table('tbl_posts')->where('id', $id)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => $request->user_id,
            'content' => $request->content,
            'image' => $imagePath,
            'updated_at' => now(),
        ]);
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
    

    // Hapus post dari database
    public function destroy($id)
    {
        // Ambil data post berdasarkan ID
        $post = DB::table('tbl_posts')->where('id', $id)->first();

        // Jika post tidak ditemukan, redirect dengan pesan error
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found');
        }

        // Hapus gambar jika ada dan bukan gambar default
        if ($post->image !== 'Noimage.jpg') {
            Storage::disk('public')->delete($post->image);
        }

        // Hapus data post dari database
        DB::table('tbl_posts')->where('id', $id)->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    // Tampilkan detail post berdasarkan ID
    public function show($id)
    {
        // Ambil data post berdasarkan ID
        $post = DB::table('tbl_posts')->where('id', $id)->first();

        // Jika post tidak ditemukan, redirect dengan pesan error
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found');
        }

        // Kirim data post ke view 'posts.read'
        return view('posts.read', compact('post'));
    }
}
