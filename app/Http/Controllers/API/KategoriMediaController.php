<?php

namespace App\Http\Controllers\API;

use App\Models\kategoriMedia;
use Illuminate\Http\Request;

class KategoriMediaController extends Controller
{
    public function index(){
        try {
            $kategori = kategoriMedia::all();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data kategori-media successful',
                'kategori' => $kategori,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data kategori-media',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try{

            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            $kategori = kategoriMedia::create($validatedData);
            
            $url = '/admin/kategori-media';

            return response()->json([
                'status' => 'success',
                'message' => 'Add kategori-media successful',
                'kategori' => $kategori,
                'url' => $url,
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add kategori-media',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $kategori = kategoriMedia::findOrFail($id);

            $kategori->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'kategori-media has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete kategori-media',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
