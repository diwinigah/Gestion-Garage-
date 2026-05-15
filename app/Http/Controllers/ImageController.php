<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function serve($path)
    {
        $fullPath = 'storage/vehicules/' . basename($path);
        
        if (!Storage::disk('public')->exists('vehicules/' . basename($path))) {
            abort(404);
        }

        $file = Storage::disk('public')->get('vehicules/' . basename($path));
        $mimeType = Storage::disk('public')->mimeType('vehicules/' . basename($path));

        return response($file, 200, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
