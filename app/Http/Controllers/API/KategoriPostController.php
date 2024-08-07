<?php

namespace App\Http\Controllers\API;

use App\Models\kategoriPost;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

    public function index_kategori($kategori){
        try {
            $ktgr = ucwords(str_replace('-', ' ',$kategori));
            $kat = Menu::where('nama_menu', $ktgr)->first();
            $kategori = kategoriPost::where('index_menu', $kat->id)->get();

            $menu = Menu::all();
        
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

    public function edit($id){
        try {
            $kategori = kategoriPost::findOrFail($id);
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data kategori-post id successful',
                'kategori' => $kategori,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data kategori-post id',
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
                'type_halaman' => 'required|string|max:255',
            ]);

            $kategori = kategoriPost::create($validatedData);
            
            if($validatedData['type_halaman'] == 'multi-artikel'){
                $url = '/admin/kategori-post';
            } else{
                $url = '/admin/kategori-halaman';
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Add kategori-post successful',
                'kategori' => $kategori,
                'url' => $url,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add kategori-post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id){
        try{
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'index_menu' => 'required',
                'deskripsi' => 'nullable|string',
                'type_halaman' => 'required|string|max:255',
            ]);

            $kategori = kategoriPost::findOrFail($id);

            $kategori->update($validatedData);

            if($validatedData['type_halaman'] == 'multi-artikel'){
                $url = '/admin/kategori-post';
            } else{
                $url = '/admin/kategori-halaman';
            }
            

            return response()->json([
                'status' => 'success',
                'message' => 'Update kategori-post successful',
                'kategori' => $kategori,
                'url' => $url,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update kategori-post',
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
