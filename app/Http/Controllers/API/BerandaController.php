<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BerandaController extends Controller
{
    public function index(){
        try {
            $allSubMenu = SubMenu::all();
            $subMenu = SubMenu::where('beranda', 1)->get();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data sub-menu successful',
                'allSubMenu' => $allSubMenu,
                'subMenu' => $subMenu,
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
                'nama_menu' => 'required|string|max:255',
            ]);

            $menu = SubMenu::create([
                'nama_menu' => ucwords($validatedData['nama_menu']),
                'kategori' => 'beranda',
                'beranda' => 1,
            ]);
            
            $url = '/admin/beranda';

            return response()->json([
                'status' => 'success',
                'message' => 'Add sub-menu successful',
                'menu' => $menu,
                'url' => $url,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e){
            Log::error('Store method failed: '.$e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add sub-menu',
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
                $subMenu = SubMenu::findOrFail($b);
                $subMenu->update([
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
            $subMenu = SubMenu::findOrFail($id);
            if($subMenu->kategori == 'beranda'){
                $subMenu->delete();
            } else{
                $subMenu->update([
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
