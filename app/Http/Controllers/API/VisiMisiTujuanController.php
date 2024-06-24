<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VisiMisiTujuan;
use Illuminate\Http\Request;

class VisiMisiTujuanController extends Controller
{
    public function index()
    {
        try{
            $Allvmt = VisiMisiTujuan::all();

            $vmt = $Allvmt[0];

            $url = '/admin/visi-misi-tujuan';

            return response()->json([
                'status' => 'success',
                'message' => 'Get data visi misi tujuan successful',
                'vmt' => $vmt,
                'url' => $url,
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve visi misi tujuan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'isi_visi' => 'nullable|string',
                'isi_misi' => 'nullable|string',
                'isi_tujuan' => 'nullable|string',
            ]);

            $vmt = VisiMisiTujuan::create($validatedData);
            
            $url = '/admin/visi-misi-tujuan';

            return response()->json([
                'status' => 'success',
                'message' => 'Add visi misi tujuan successful',
                'akreditasi' => $vmt,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add visi misi tujuan', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit()
    {
        try {
            $Allvmt = VisiMisiTujuan::all();

            $vmt = $Allvmt[0];

            $url = '/admin/visi-misi-tujuan/edit';

            return response()->json([
                'status' => 'success',
                'message' => 'Get Kerjasama Mitra successful',
                'vmt' => $vmt,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get Kerjasama Mitra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $Allvmt = VisiMisiTujuan::all();

            $vmt = $Allvmt[0];

            $validatedData = $request->validate([
                'isi_visi' => 'nullable|string',
                'isi_misi' => 'nullable|string',
                'isi_tujuan' => 'nullable|string',
            ]);

            $vmt->update($validatedData);
            $url = '/admin/visi-misi-tujuan';

            return response()->json([
                'status' => 'success',
                'message' => 'Update visi misi tujuan successful',
                'akreditasi' => $vmt,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to update visi misi tujuan', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function destroy()
    // {
    //     try {
    //         $Allvmt = VisiMisiTujuan::all();

    //         $vmt = $Allvmt[0];

    //         $vmt->delete();
    //         $url = '/admin/visi-misi-tujuan';

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'visi misi tujuan has been removed',
    //             'url' => $url,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to remove visi misi tujuan',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
