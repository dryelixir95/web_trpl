<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DMutu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class DMutuController extends Controller
{
    public function index()
    {
        try {
            $dokumenMutu = DMutu::all();
            $url = '/admin/dokumen-mutu';

            return response()->json([
                'status' => 'success',
                'message' => 'Get data dokumen mutu successful',
                'dokumenMutu' => $dokumenMutu,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get dokumen mutu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_Dmutu' => 'required|string|max:255',
                'file_Dmutu' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:2048',
                'keterangan' => 'nullable|string',
            ]);

            if ($request->hasFile('file_Dmutu')) {
                $file = $request->file('file_Dmutu');
                if ($file->isValid()) {
                    $FileName = uniqid('Dmutu_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('files/dmutu'), $FileName);
                    $validatedData['file_Dmutu'] = $FileName;
                }
            }

            $dokumenMutu = DMutu::create($validatedData);
            $url = '/admin/dokumen-mutu';

            return response()->json([
                'status' => 'success',
                'message' => 'Add dokumen mutu successful',
                'dokumenMutu' => $dokumenMutu,
                'url' => $url,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add dokumen mutu', 
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add dokumen mutu',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function download($id)
    {
        try {
            $dokumenMutu = DMutu::findOrFail($id);
            $filePath = public_path('files/dmutu/' . $dokumenMutu->file_Dmutu);

            if (!File::exists($filePath)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File not found'
                ], 404);
            }

            return response()->download($filePath);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to download file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function view($id)
    {
        try {
            $dokumenMutu = DMutu::findOrFail($id);
            $filePath = public_path('files/dmutu/' . $dokumenMutu->file_Dmutu);

            if (!File::exists($filePath)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File not found'
                ], 404);
            }

            return response()->file($filePath);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to view file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $dokumenMutu = DMutu::findOrFail($id);
            $filePath = public_path('files/dmutu/' . $dokumenMutu->file_Dmutu);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $dokumenMutu->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Dokumen mutu has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete dokumen mutu',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
