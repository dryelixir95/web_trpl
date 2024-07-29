<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::all();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data posts successful',
                'posts' => $posts,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data posts',
                'error' => $e->getMessage()
            ], 500);
        }       
    }

    public function store(Request $request)
    {
        try {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'kategori' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tags' => 'array',
                'komen' => 'nullable|string',
            ]);

            // Buat instance Post dan simpan data
            $post = Post::create([
                'judul' => $validatedData['judul'],
                'tanggal' => $validatedData['tanggal'],
                'kategori' => $validatedData['kategori'],
                'deskripsi' => $validatedData['deskripsi'],
                'tag' => json_encode($validatedData['tags']),
            ]);

            $url = '/admin/post';

            return response()->json([
                'message' => 'Post created successfully', 
                'url' => $url,
                'post' => $post],
                 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create post',
                'message' => $e->getMessage()], 
                500);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);

            $post->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'postingan has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete postingan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
