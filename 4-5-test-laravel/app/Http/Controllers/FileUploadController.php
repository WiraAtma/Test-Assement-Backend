<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,txt|max:10240', // max 10MB
        ], [
            'file.required' => 'File must be uploaded.',
            'file.file' => 'File must be a valid file.',
            'file.mimes' => 'Only jpg, jpeg, png, pdf, and txt files are allowed.',
            'file.max' => 'The file may not be greater than 10MB.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $file = $request->file('file');
        $path = $file->store('file-uploads');
        $url = Storage::url($path);
    
        return response()->json([
            'message' => 'File uploaded successfully.',
            'file_url' => $url,
        ]);
    }

        public function getFile($filename)
        {
            if (!Storage::exists('file-uploads/' . $filename)) {
                return response()->json(['message' => 'File not found.'], Response::HTTP_NOT_FOUND);
            }

            return Storage::download('file-uploads/' . $filename);
        }
}
