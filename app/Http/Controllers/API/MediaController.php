<?php

namespace App\Http\Controllers\API;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function index(){
        try {
            $media = Media::all();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data media successful',
                'media' => $media,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data media',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try{

            $validatedData = $request->validate([
                'media' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xls,xlsx|max:2048',
                'kategori' => 'required|string|max:255',
                'keterangan' => 'nullable|string'
            ]);

            if ($request->hasFile('media')) {
                $file = $request->file('media');
                if ($file->isValid()) {
                    $FileName = uniqid('media_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('media'), $FileName);
                    $validatedData['media'] = $FileName;
                }
            }

            $media = Media::create($validatedData);
            
            $url = '/admin/media';

            return response()->json([
                'status' => 'success',
                'message' => 'Add media successful',
                'media' => $media,
                'url' => $url,
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add media',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $media = Media::find($id);
            $filePath = public_path('media/' . $media->media);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $media->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'media has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete media',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
