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

    public function editTemplate(Request $request)
    {
        $templatePath = storage_path('app/templates/template.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        // Mengganti teks di template
        $templateProcessor->setValue('nama', $request->input('nama'));
        $templateProcessor->setValue('alamat', $request->input('alamat'));

        // Mengganti logo di template
        $logoPath = storage_path('app/public/logo/' . $request->file('logo')->getClientOriginalName());
        $request->file('logo')->move(storage_path('app/public/logo/'), $request->file('logo')->getClientOriginalName());
        $templateProcessor->setImageValue('logo', array('path' => $logoPath, 'width' => 100, 'height' => 100, 'ratio' => true));

        // Menyimpan dokumen yang telah diubah
        $outputPath = storage_path('app/public/output/' . time() . '_edited_template.docx');
        $templateProcessor->saveAs($outputPath);

        return response()->download($outputPath);
    }
}
