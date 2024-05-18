<?php

namespace App\Http\Controllers;

class TemplateController extends Controller
{
    public function index()
    {
        return view('template.index');
    }

    public function defaultTemplate()
    {
        $filePath = public_path('template.pdf');
        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            return response()->json(['message' => 'File PDF tidak ditemukan.'], 404);
        }    
    }
}
