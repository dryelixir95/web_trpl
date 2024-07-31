<?php

namespace App\Http\Controllers\API;

use App\Models\kategoriPost;
use App\Models\Menu;
use Illuminate\Http\Request;

class KategoriPostController extends Controller
{
    public function index(){
        try {
            $menu = Menu::all();
            $kategori = kategoriPost::all();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data kategori-post successful',
                'kategori' => $kategori,
                'menu' => $menu,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data kategori-post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try{
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'index_menu' => 'required',
                'deskripsi' => 'nullable|string',
            ]);

            $kategori = kategoriPost::create($validatedData);
            
            $url = '/admin/kategori-post';

            return response()->json([
                'status' => 'success',
                'message' => 'Add kategori-post successful',
                'kategori' => $kategori,
                'url' => $url,
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add kategori-post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $kategori = kategoriPost::findOrFail($id);

            $kategori->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'kategori-post has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete kategori-post',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
