<?php

namespace App\Http\Controllers\API;

use App\Models\Media;
use App\Models\setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        try {
            $setting = setting::all();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data setting successful',
                'setting' => $setting,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data setting',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try {
            // Validasi data yang diterima
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'value' => 'required',
            ]);
    
            // Cek apakah 'value' adalah file atau teks
            if ($request->hasFile('value')) {
                $file = $request->file('value');
                $originalName = $file->getClientOriginalName();
                $file->move(public_path('media'), $originalName);
                $validatedData['value'] = $originalName;

                Media::create([
                    'media' => $originalName,
                    'kategori' => $request->input('name'),
                ]);
            }
    
            // Cari setting berdasarkan name, jika ada update, jika tidak buat baru
            $setting = Setting::updateOrCreate(
                ['name' => $validatedData['name']],
                ['value' => $validatedData['value']]
            );
        
            $url = '/admin/setting';
    
            return response()->json([
                'status' => 'success',
                'message' => 'Setting saved successfully',
                'setting' => $setting,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save setting',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
