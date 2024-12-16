<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekomtekDocument;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    public function download($id)
    {
        $document = RekomtekDocument::findOrFail($id);
        $path = Storage::disk('public')->path($document->file_path);
        
        if (!Storage::disk('public')->exists($document->file_path)) {
            return response()->json(['error' => 'File not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->download(
            $path, 
            $document->original_name ?? basename($document->file_path)
        );
    }

    public function view($id)
    {
        $document = RekomtekDocument::findOrFail($id);
        $path = Storage::disk('public')->path($document->file_path);
        
        if (!Storage::disk('public')->exists($document->file_path)) {
            return response()->json(['error' => 'File not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->file($path);
    }
}
