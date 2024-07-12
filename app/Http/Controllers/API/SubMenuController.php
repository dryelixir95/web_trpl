<?php

namespace App\Http\Controllers\API;

use App\Models\SubMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SubMenuController extends Controller
{
    public function index($slug){

        try {
            $subMenu = SubMenu::where('slug', $slug)->get();
        
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

    public function store(Request $request, $slug){
        try{

            $validatedData = $request->validate([
                'nama_menu' => 'required|string|max:255',
                'page' => 'required|string',
            ]);

            $nama_menu = $validatedData['nama_menu'];

            $menu = SubMenu::create([
                'nama_menu' => $nama_menu,
                'slug' => $slug,
            ]);

            $page = $validatedData['page'];
            
            $url = '/admin/menu/'. $page;

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

    public function destroy($slug, $id)
    {
        try {
            $menu = SubMenu::where('slug', $slug)->where('id', $id)->first();
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
