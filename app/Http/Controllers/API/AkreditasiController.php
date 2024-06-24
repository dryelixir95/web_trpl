<?php
namespace App\Http\Controllers\API;

use App\Models\Akreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AkreditasiController extends Controller
{
    public function index()
    {
        try {
            $Allakreditasi = Akreditasi::all();

            $akreditasi = $Allakreditasi[0];

            $url = '/admin/akreditasi';
            
            return response()->json([
                'status' => 'success',
                'message' => 'Get data akreditasi successful',
                'akreditasis' => $akreditasi,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve akreditasi data: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve akreditasi data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'tgl_akreditasi' => 'required|date',
                'file_akreditasi' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048'
            ]);

            if ($request->hasFile('file_akreditasi')) {
                $file = $request->file('file_akreditasi');
                if ($file->isValid()) {
                    $fileName = uniqid('akreditasi_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('files/akreditasi'), $fileName);
                    $validatedData['file_akreditasi'] = $fileName;
                }
            }

            $akreditasi = Akreditasi::create($validatedData);
            $url = '/admin/akreditasi';

            return response()->json([
                'status' => 'success',
                'message' => 'Add akreditasi successful',
                'akreditasi' => $akreditasi,
                'url' => $url,
            ]);
        } catch (ValidationException $e) {
            Log::error('Failed to add akreditasi: ' . $e->getMessage());
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add akreditasi', 
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve akreditasi data: ' . $e->getMessage());
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add akreditasi', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $Allakreditasi = Akreditasi::all();

            $akreditasi = $Allakreditasi[0];

            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'tgl_akreditasi' => 'required|date',
                'file_akreditasi' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048'
            ]);


            if ($request->hasFile('file_akreditasi')) {
                if ($akreditasi->file_akreditasi) {
                    File::delete(public_path('files/akreditasi/' . $akreditasi->file_akreditasi));
                }

                $file = $request->file('file_akreditasi');
                $fileName = uniqid('akreditasi_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files/akreditasi'), $fileName);
                $validatedData['file_akreditasi'] = $fileName;
            }

            $akreditasi->update($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Update akreditasi successful',
                'akreditasi' => $akreditasi,
            ]);
        } catch (ValidationException $e) {
            Log::error('Failed to add akreditasi: ' . $e->getMessage());
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to update akreditasi', 
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to update akreditasi', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function destroy()
    // {
    //     try {
    //         $Allakreditasi = Akreditasi::all();

    //         $akreditasi = $Allakreditasi[0];

    //         if ($akreditasi->file_akreditasi) {
    //             File::delete(public_path('files/akreditasi/' . $akreditasi->file_akreditasi));
    //         }

    //         $akreditasi->delete();
    //         $url = '/admin/akreditasi';

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Akreditasi has been removed',
    //             'url' => $url,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to remove Akreditasi',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
