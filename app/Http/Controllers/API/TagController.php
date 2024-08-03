<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        try {
            $tag = Tag::all();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Get data tag successful',
                'tag' => $tag,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data tag',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try{

            $validatedData = $request->validate([
                'tag' => 'required|string|max:255',
            ]);

            $tag = Tag::create($validatedData);
            
            $url = '/admin/tag';

            return response()->json([
                'status' => 'success',
                'message' => 'Add tag successful',
                'tag' => $tag,
                'url' => $url,
            ]);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add tag',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);

            $tag->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'tag has been removed',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete tag',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
