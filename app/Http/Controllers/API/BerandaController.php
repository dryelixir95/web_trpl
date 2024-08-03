<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\kategoriPost;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BerandaController extends Controller
{
    public function index(){
        try {
            $allKategori = kategoriPost::all();
            $kategori = kategoriPost::where('beranda', 1)->get();
            $menu = Menu::all();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data sub-menu successful',
                'allKategori' => $allKategori,
                'kategori' => $kategori,
                'menu' => $menu,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data sub-menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try{
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'type_halaman' => 'required|string|max:255',
            ]);

            $validatedData['beranda'] = 1;

            $kategori = kategoriPost::create($validatedData);
            
            $url = '/admin/beranda';

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
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add kategori-post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request){
        try {
            $validatedData = $request->validate([
                'beranda' => 'required|array',
            ]);           
            
            $beranda = ($validatedData['beranda']);

            foreach($beranda as $b){
                $kategori = kategoriPost::findOrFail($b);
                $kategori->update([
                    'beranda' => 1,
                ]);
            }
            
            $url = '/admin/beranda';
        
            return response()->json([
                'status' => 'success',
                'message' => 'Update sub-menu successful',
                'url' => $url,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update sub-menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id){
        try {
            $kategori = kategoriPost::findOrFail($id);
            if($kategori->kategori == 'beranda'){
                $kategori->delete();
            } else{
                $kategori->update([
                    'beranda' => 0,
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'sub-menu beranda has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete sub-menu beranda',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
