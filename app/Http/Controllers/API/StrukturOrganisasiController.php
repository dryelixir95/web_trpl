<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        try {
            $AllStrukturOrganisasi = StrukturOrganisasi::all();

            $strukturOrganisasi = $AllStrukturOrganisasi[0];

            $url = '/admin/struktur-organisasi';
            
            return response()->json([
                'status' => 'success',
                'message' => 'Get data struktur organisasi successful',
                'strukturOrganisasi' => $strukturOrganisasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve struktur organisasi data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'file_struktur' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048'
            ]);

            if ($request->hasFile('file_struktur')) {
                $file = $request->file('file_struktur');
                if ($file->isValid()) {
                    $fileName = uniqid('struktur_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('files/strukturOrganisasi'), $fileName);
                    $validatedData['file_struktur'] = $fileName;
                }
            }

            $strukturOrganisasi = StrukturOrganisasi::create($validatedData);
            $url = '/admin/struktur-organisasi';

            return response()->json([
                'status' => 'success',
                'message' => 'Add struktur organisasi successful',
                'strukturOrganisasi' => $strukturOrganisasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add struktur organisasi', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit()
    {
        try {
            $AllStrukturOrganisasi = StrukturOrganisasi::all();

            $strukturOrganisasi = $AllStrukturOrganisasi[0];

            $url = '/admin/struktur-organisasi/edit';

            return response()->json([
                'status' => 'success',
                'message' => 'Get struktur organisasi successful',
                'strukturOrganisasi' => $strukturOrganisasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get struktur organisasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $AllStrukturOrganisasi = StrukturOrganisasi::all();

            $strukturOrganisasi = $AllStrukturOrganisasi[0];
            
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'file_struktur' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048'
            ]);

            if ($request->hasFile('file_struktur')) {
                if ($strukturOrganisasi->file_struktur) {
                    File::delete(public_path('files/strukturOrganisasi/' . $strukturOrganisasi->file_struktur));
                }

                $file = $request->file('file_struktur');
                $fileName = uniqid('strukturOrganisasi_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files/strukturOrganisasi'), $fileName);
                $validatedData['file_struktur'] = $fileName;
            }

            $strukturOrganisasi->update($validatedData);
            $url = '/admin/struktur-organisasi';

            return response()->json([
                'status' => 'success',
                'message' => 'Update struktur organisasi successful',
                'strukturOrganisasi' => $strukturOrganisasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to update struktur organisasi', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //     public function destroy()
    // {
    //     try {
    //         $AllStrukturOrganisasi = StrukturOrganisasi::all();

    //         $strukturOrganisasi = $AllStrukturOrganisasi[0];

    //         if ($strukturOrganisasi->file_struktur) {
    //             File::delete(public_path('files/strukturOrganisasi/' . $strukturOrganisasi->file_struktur));
    //         }

    //         $strukturOrganisasi->delete();
    //         $url = '/admin/struktur-organisasi';

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'struktur organisasi has been removed',
    //             'url' => $url,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to remove struktur organisasi',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
