<?php

namespace App\Http\Controllers\API;

use App\Models\SubMenu;
use App\Models\SubMenuField;
use Illuminate\Http\Request;

class SubMenuFieldController extends Controller
{
    public function index($kategori, $submenu){
        try {
            $allsubMenu = SubMenu::all();
            $subMenu_id = '';

            foreach ($allsubMenu as $subMenu){
                if(strtolower(str_replace(' ', '-', $subMenu->nama_menu))  == $submenu){
                    $subMenu_id = $subMenu->id;
                }
            }
            $fields = SubMenuField::where('submenu_id', $subMenu_id)->get();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data field sub-menu successful',
                'fields' => $fields,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data field sub-menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request, $kategori, $submenu){
        try{
            $validatedData = $request->validate([
                'fields' => 'required|array',
            ]);

            $allsubMenu = SubMenu::all();
            $subMenu_id = '';

            foreach ($allsubMenu as $subMenu){
                if(strtolower(str_replace(' ', '-', $subMenu->nama_menu))  == $submenu){
                    $subMenu_id = $subMenu->id;
                    break;
                }
            }

            $allFieldSubMenu = SubMenuField::all();
            foreach ($allFieldSubMenu as $fieldSubMenu){
                if($fieldSubMenu->submenu_id == $subMenu_id){
                    $fieldSubMenu->delete();
                }
            }

            $fields = $validatedData['fields'];

            foreach ($fields as $field){
                $nullField = $field['nullable'] ? 'null' : 'not';
                SubMenuField::create([
                    'nama_field' => ucwords($field['name']),
                    'type_field' => $field['type'],
                    'null' => $nullField,
                    'tag' => strtolower(str_replace(' ', '-', $field['name'])),
                    'submenu_id' => $subMenu_id,
                ]);
            }
            
            $url = '/admin/'. $kategori.'/'.$submenu;

            return response()->json([
                'status' => 'success',
                'message' => 'Add field sub-menu successful',
                'url' => $url,
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add field sub-menu',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
