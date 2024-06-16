<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    public function index()
    {
        return view('template.index');
    }

    public function defaultTemplate()
    {
        $userId = Auth::id();
        $user = User::find($userId);

        // Jika pengguna tidak ditemukan, kembalikan respons error
        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak ditemukan.'], 404);
        }

    $jenisOrganisasi = $user->jenisorganisasi;
     
    // Redirect ke view yang sesuai berdasarkan jenis organisasi
        if ($jenisOrganisasi === "BEM") {
            $filePath = public_path('templateBem.pdf');
            
            if (file_exists($filePath)) {
                
                return response()->file($filePath);
            } else {
                return response()->json(['message' => 'File PDF tidak ditemukan.'], 404);
            }    
        }else{
            $filePath = public_path('template.pdf');
            if (file_exists($filePath)) {
                return response()->file($filePath);
            } else {
                return response()->json(['message' => 'File PDF tidak ditemukan.'], 404);
            }    
        }

    }
}
