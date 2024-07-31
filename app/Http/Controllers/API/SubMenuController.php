<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\SubMenu;

class SubMenuController extends Controller
{
    public function index($kategori){
        try {
            $subMenu = SubMenu::where('kategori', $kategori)->get();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data sub-menu successful',
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

    public function store(Request $request, $kategori){
        try{
            $validatedData = $request->validate([
                'nama_menu' => 'required|string|max:255',
            ]);

            $menu = Menu::all();
            $menu_id = '';

            foreach ($menu as $menu){
                if(strtolower(str_replace(' ', '-', $menu->nama_menu)) == $kategori){
                    $menu_id = $menu->id;
                }
            }

            $menu = SubMenu::create([
                'nama_menu' => ucwords($validatedData['nama_menu']),
                'kategori' => $kategori,
                'menu_id' => $menu_id,
            ]);
            
            $url = '/admin/'. $kategori;

            return response()->json([
                'status' => 'success',
                'message' => 'Add sub-menu successful',
                'menu' => $menu,
                'url' => $url,
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add sub-menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($kategori, $id){
        try {
            $subMenu = SubMenu::where('kategori', $kategori)->where('id', $id)->first();

            return response()->json([
                'status' => 'success',
                'message' => 'get sub-menu successfull',
                'submenu' => $subMenu,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get sub-menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $kategori, $id){
        try {
            $validatedData = $request->validate([
                'nama_menu' => 'required|string|max:255',
            ]);

            $subMenu = SubMenu::where('kategori', $kategori)->where('id', $id)->first();
            $subMenu->update([
                'nama_menu' => $validatedData['nama_menu'],
            ]);

            $url = '/admin/'. $kategori;

            return response()->json([
                'status' => 'success',
                'message' => 'get sub-menu successfull',
                'submenu' => $subMenu,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get sub-menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($kategori, $id)
    {
        try {
            $menu = SubMenu::where('kategori', $kategori)->where('id', $id)->first();
            $menu->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'sub-menu has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete sub-menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
