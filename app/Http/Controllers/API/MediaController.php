<?php

namespace App\Http\Controllers\API;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class MediaController extends Controller
{
    public function index(){
        try {
            $media = Media::all();
            $mediaPath = public_path('media/ckeditor/');
            
            // Check if the directory exists
            if (File::exists($mediaPath)) {
                $files = File::allFiles($mediaPath);
            } else {
                $files = [];
            }
    
            // Prepare an array to hold file details
            $mediaFiles = [];
            foreach ($files as $file) {
                $mediaFiles[] = [
                    'name' => $file->getFilename(),
                    'url' => asset('media/ckeditor/' . $file->getFilename()),
                    'size' => $file->getSize(),
                    'type' => File::mimeType($file->getPathname()),
                ];
            }
            
            return response()->json([
                'status' => 'success',
                'message' => 'Get data media successful',
                'media' => $media,
                'mediaFiles' => $mediaFiles,
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

            // $kategori = File::mimeType($validatedData['media']->getPathname());
            // dd($kategori);

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
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add media',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function upload_ckeditor(Request $request){
        try{
            $validatedData = $request->validate([
                'upload' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                if ($file->isValid()) {
                    $FileName = uniqid('media_') . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('media/ckeditor'), $FileName);
                    $validatedData['upload'] = $FileName;
                }
            }

            $url = '/media/ckeditor/' . $validatedData['upload'];

            return response()->json(['url' => $url]);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
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

    public function destroy_storage($name)
    {
        try {
            $filePath = public_path('media/ckeditor/' . $name);
    
            if (File::exists($filePath)) {
                File::delete($filePath);
                return response()->json([
                    'status' => 'success',
                    'message' => 'media has been removed',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Media not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete media',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
