<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sejarah;
use Illuminate\Support\Facades\File;

class SejarahController extends Controller
{
    public function index()
    {
        try{
            $AllSejarah = Sejarah::all();

            $sejarah = $AllSejarah[0];

            $url = '/admin/sejarah';

            return response()->json([
                'status' => 'success',
                'message' => 'Get data sejarah successful',
                'sejarah' => $sejarah,
                'url' => $url,
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve sejarah data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'isi_sejarah' => 'string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $fileName = uniqid('sejarah_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/sejarah'), $fileName);
                    $validatedData['gambar'] = $fileName;
                }
            }

            $sejarah = Sejarah::create($validatedData);
            $url = '/admin/sejarah';

            return response()->json([
                'status' => 'success',
                'message' => 'Add sejarah successful',
                'sejarah' => $sejarah,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add sejarah', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit()
    {
        try {
            $AllSejarah = Sejarah::all();

            $sejarah = $AllSejarah[0];

            $url = '/admin/sejarah/edit';

            return response()->json([
                'status' => 'success',
                'message' => 'Get Kerjasama Mitra successful',
                'sejarah' => $sejarah,
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
            $AllSejarah = Sejarah::all();

            $sejarah = $AllSejarah[0];

            $validatedData = $request->validate([
                'isi_sejarah' => 'string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('gambar')) {
                if ($sejarah->gambar) {
                    File::delete(public_path('images/sejarah/' . $sejarah->gambar));
                }

                $file = $request->file('gambar');
                $fileName = uniqid('sejarah_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/sejarah'), $fileName);
                $validatedData['gambar'] = $fileName;
            }

            $sejarah->update($validatedData);
            $url = '/admin/sejarah';

            return response()->json([
                'status' => 'success',
                'message' => 'Update sejarah successful',
                'sejarah' => $sejarah,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to update akreditasi', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy_gambar()
    {
        try {
            $AllSejarah = Sejarah::all();

            $sejarah = $AllSejarah[0];


            if ($sejarah->gambar) {
                File::delete(public_path('images/sejarah/' . $sejarah->gambar));
            }

            $sejarah->update([
                'gambar' => null,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'sejarah has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove sejarah',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
