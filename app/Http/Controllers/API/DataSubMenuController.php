<?php

namespace App\Http\Controllers\API;

use App\Models\DataSubMenu;
use App\Models\DetailDataSubMenu;
use App\Models\SubMenu;
use App\Models\SubMenuField;
use Illuminate\Http\Request;

class DataSubMenuController extends Controller
{
    public function index($kategori, $submenu){
        try{
            $allsubMenu = SubMenu::all();
            $subMenu_id = '';

            foreach ($allsubMenu as $subMenu){
                if(strtolower(str_replace(' ', '-', $subMenu->nama_menu))  == $submenu){
                    $subMenu_id = $subMenu->id;
                }
            }

            $dataSubMenu = DataSubMenu::where('submenu_id', $subMenu_id)->with('detailDataSubmenu')->get();

            $fields = SubMenuField::where('submenu_id', $subMenu_id)->get();

            $dataDetailSubMenu = [];
            foreach ($dataSubMenu as $dataSubMenu) {
                $dataDetailSubMenu[] = $dataSubMenu->detailDataSubmenu;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Get data data-sub-menu successful',
                'dataDetailSubMenu' => $dataDetailSubMenu,
                'fields' => $fields,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data data-sub-menu',
                'error' => $e->getMessage()
            ], 500);
        }    
    }

    public function store(Request $request, $kategori, $submenu){
        try {
            $input = $request->except('_token');

            $allsubMenu = SubMenu::all();
            $subMenu_id = '';

            foreach ($allsubMenu as $subMenu){
                if(strtolower(str_replace(' ', '-', $subMenu->nama_menu))  == $submenu){
                    $subMenu_id = $subMenu->id;
                    break;
                }
            }

            $dataSubMenu = new DataSubMenu();
            $dataSubMenu->submenu_id =$subMenu_id;
            $dataSubMenu->save();  
            
            foreach ($input as $key => $value) {
                if (str_ends_with($key, '-type')) {
                    continue;
                }
                
                $typeKey = '';
                foreach ($input as $k => $v){
                    if (str_ends_with($k, '-type')) {
                        if($k == $key.'-type'){
                            $typeKey = $v;
                            break;
                        }
                    }    
                }

                if ($typeKey == 'text' || $typeKey == 'textarea' || $typeKey == 'date') {
                    if (!empty($value)) {
                        DetailDataSubMenu::create([
                            'tag' => $key,
                            'value' => $value,
                            'dataSubmenu_id' => $dataSubMenu->id,
                        ]);
                    }
                } else{
                    if ($request->hasFile($key)) {
                        $file = $request->file($key);
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('files'), $fileName);

                        DetailDataSubMenu::create([
                            'tag' => $key,
                            'value' => $fileName,
                            'dataSubmenu_id' => $dataSubMenu->id,
                        ]);
                    }
                }  
            }

            $url = '/admin/'. $kategori.'/'.$submenu;

            return response()->json([
                'status' => 'success',
                'message' => 'Data saved successfully',
                'data' => $input,
                'url' => $url,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($kategori, $submenu, $id){
        
    }

    public function download($kategori, $submenu, $id){
        
    }

    public function edit($kategori, $submenu, $id){

    }

    public function update(Request $request, $kategori, $submenu, $id){
        
    }

    public function destroy($kategori, $submenu, $id){
        
    }

}
