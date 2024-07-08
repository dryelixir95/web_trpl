<?php

namespace App\Http\Controllers\API;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class BeritaController extends Controller
{
    public function index()
    {
        try {
            $beritas = Berita::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Get data berita successful',
                'berita' => $beritas,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get berita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judul_berita' => 'required|string|max:255',
                'isi_berita' => 'required|string',
                'tgl_berita' => 'required|date',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                if ($file->isValid()) {
                    $FileName = uniqid('berita_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/berita'), $FileName);
                    $validatedData['gambar'] = $FileName;
                }
            }

            $berita = Berita::create($validatedData);
            $url = '/admin/berita';

            return response()->json([
                'status' => 'success',
                'message' => 'Add berita successful',
                'berita' => $berita,
                'url' => $url
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add akreditasi', 
                'errors' => $e->errors(),
            ], 422);
        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add berita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            $url = sprintf('/admin/berita/%d', $id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get berita successful',
                'berita' => $berita,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get berita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $berita = Berita::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Get berita successful',
                'berita' => $berita,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get berita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $berita = Berita::findOrFail($id);

            $validatedData = $request->validate([
                'judul_berita' => 'required|string|max:255',
                'isi_berita' => 'required|string',
                'tgl_berita' => 'required|date',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('gambar')) {
                if ($berita->gambar) {
                    File::delete(public_path('images/berita/' . $berita->gambar));
                }

                $file = $request->file('gambar');
                $FileName = uniqid('berita_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/berita'), $FileName);
                $validatedData['gambar'] = $FileName;
            }

            $berita->update($validatedData);
            $url = '/admin/berita';

            return response()->json([
                'status' => 'success',
                'message' => 'Update berita successful',
                'berita' => $berita,
                'url' => $url
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Failed to add akreditasi', 
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update berita',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);

            $gambar = public_path('images/berita/' . $berita->gambar);

            if (File::exists($gambar)) {
                File::delete($gambar);
            }

            $berita->delete();
            $url = '/admin/berita';

            return response()->json([
                'status' => 'success',
                'message' => 'Berita has been removed',
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove berita',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
