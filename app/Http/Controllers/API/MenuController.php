<?php

namespace App\Http\Controllers\API;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index(){
        try {
            $hak = Auth::user()->role;

            if($hak == 'Admin'){
                $menu = Menu::all();

            } else{
                $menu = Menu::where('hak_akses', 2)->get();
            }
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data menu successful',
                'menu' => $menu,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try{

            $validatedData = $request->validate([
                'nama_menu' => 'required|string|max:255',
                'hak_akses' => 'required|array'
            ]);

            $nama_menu = ucwords($validatedData['nama_menu']);

            $hak = $validatedData['hak_akses'];

            // Inisialisasi hak_akses
            $hak_akses = '';
    
            // Mengatur nilai hak_akses berdasarkan pilihan
            if (in_array('Admin', $hak) && in_array('Kaprodi', $hak)) {
                $hak_akses = '2';
            } elseif (in_array('Admin', $hak)) {
                $hak_akses = '1';
            }

            $menu = Menu::create([
                'nama_menu' => $nama_menu,
                'hak_akses' => $hak_akses,
            ]);
            $url = '/admin/menu';

            return response()->json([
                'status' => 'success',
                'message' => 'Add menu successful',
                'menu' => $menu,
                'url' => $url,
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id){
        try {
            $menu = Menu::findOrFail($id);
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data menu successful',
                'menu' => $menu,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id){
        try{
            $menu = Menu::findOrFail($id);

            $validatedData = $request->validate([
                'nama_menu' => 'required|string|max:255',
                'hak_akses' => 'required|array'
            ]);

            $nama_menu = $validatedData['nama_menu'];

            $hak = $validatedData['hak_akses'];

            // Inisialisasi hak_akses
            $hak_akses = '';
    
            // Mengatur nilai hak_akses berdasarkan pilihan
            if (in_array('Admin', $hak) && in_array('Kaprodi', $hak)) {
                $hak_akses = '2';
            } elseif (in_array('Admin', $hak)) {
                $hak_akses = '1';
            }

            $menu->update([
                'nama_menu' => $nama_menu,
                'hak_akses' => $hak_akses,
            ]);
            $url = '/admin/menu';

            return response()->json([
                'status' => 'success',
                'message' => 'Add menu successful',
                'menu' => $menu,
                'url' => $url,
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $menu = Menu::find($id);
            $menu->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'menu has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
