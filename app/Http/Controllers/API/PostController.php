<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\kategoriPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::all();
            $kategori = kategoriPost::all();
            $isAdmin = false;
            if(Auth::user()){
                if(Auth::user()->role == 'Admin'){
                    $isAdmin = true;
                }
            } 
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data posts successful',
                'posts' => $posts,
                'kategori' => $kategori,
                'isAdmin' => $isAdmin,
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
                'kategori' => 'required',
                'deskripsi' => 'required|string',
                'tags' => 'nullable',
                'komen' => 'nullable|string',
            ]);

            // Periksa apakah kunci 'tags' ada dalam permintaan
            if ($request->has('tags')) {
                $tags = $request->input('tags');
            } else {
                $tags = [];
            }

            $deskripsi = $validatedData['deskripsi'];

            // Buat instance Post dan simpan data
            $post = Post::create([
                'judul' => $validatedData['judul'],
                'tanggal' => $validatedData['tanggal'],
                'kategori' => $validatedData['kategori'],
                'deskripsi' => $deskripsi,
                'tag' => json_encode($tags),
            ]);

            $kategori = kategoriPost::findOrFail($validatedData['kategori']);

            if($kategori->type_halaman == 'multi-artikel'){
                $url = '/admin/post';
            } else{
                $url = '/admin/halaman';
            }

            return response()->json([
                'message' => 'Post created successfully', 
                'url' => $url,
                'post' => $post],
                 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create post',
                'message' => $e->getMessage()], 
                500);
        }
    }

    public function get_id($id)
    {
        try {
            $post = Post::where('kategori', $id)->first();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data post successful',
                'post' => $post,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data post',
                'error' => $e->getMessage()
            ], 500);
        }       
    }

    public function edit($id)
    {
        try {
            $post = Post::findOrFail($id);
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data post successful',
                'post' => $post,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data post',
                'error' => $e->getMessage()
            ], 500);
        }       
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'kategori' => 'required',
                'deskripsi' => 'required|string',
                'tags' => 'nullable',
                'komen' => 'nullable|string',
            ]);

            // Periksa apakah kunci 'tags' ada dalam permintaan
            if ($request->has('tags')) {
                $tags = $request->input('tags');
            } else {
                $tags = [];
            }

            // Buat instance Post dan simpan data

            $post = Post::findOrFail($id);

            $post->update([
                'judul' => $validatedData['judul'],
                'tanggal' => $validatedData['tanggal'],
                'kategori' => $validatedData['kategori'],
                'deskripsi' => $validatedData['deskripsi'],
                'tag' => json_encode($tags),
            ]);

            $kategori = kategoriPost::findOrFail($validatedData['kategori']);

            if($kategori->type_halaman == 'multi-artikel'){
                $url = '/admin/post';
            } else{
                $url = '/admin/halaman';
            }

            return response()->json([
                'message' => 'Post update successfully', 
                'url' => $url,
                'post' => $post],
                 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update post',
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
