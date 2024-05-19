<?php

namespace App\Http\Controllers;

use App\Instansi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Auth;

class DokumenController extends Controller
{
    public function index()
    {
        return view('dokumen.index');
    }

    public function create()
    {
        return view('dokumen.create');
    }
    
    public function createtemp()
    {
        return view('dokumen.createtemp');
    }
    
    public function editTemplate(Request $request)
    {
        
        $userId = Auth::id();
        $instansi = Instansi::where('user_id', $userId)->first();

        if (!$instansi) {
            return response()->json(['message' => 'Instansi tidak ditemukan.'], 404);
        }
        
        
        $templatePath = public_path('004 - Upgrading - Peminjangan Gedung  (1).docx');
        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValue('NAMA_ORGANISASI', strtoupper($instansi->nama));

        // Mengganti teks di template
        $templateProcessor->setValue('JURUSAN', strtoupper($request->input('jurusan')));
        $templateProcessor->setValue('FAKULTAS', strtoupper($request->input('fakultas')));
        $templateProcessor->setValue('website', $request->input('website'));
        $templateProcessor->setValue('email', ($instansi->email));
        $templateProcessor->setValue('nomor_surat', $request->input('nomor_surat'));
        $templateProcessor->setValue('hal', $request->input('hal'));
        $templateProcessor->setValue('Tujuan', $request->input('tujuan'));
        $templateProcessor->setValue('nama_acara', $request->input('nama_acara'));
        $templateProcessor->setValue('Jam_Mulai', $request->input('jam_mulai'));
        $templateProcessor->setValue('jam_selesai', $request->input('jam_selesai'));
        $templateProcessor->setValue('lokasi', $request->input('lokasi'));
        $templateProcessor->setValue('nama_ketua', $request->input('nama_ketua'));
        $templateProcessor->setValue('nim_ketua', $request->input('nim_ketua'));
        $templateProcessor->setValue('nama_sekre', $request->input('nama_sekre'));
        $templateProcessor->setValue('nim_sekre', $request->input('nim_sekre'));
        $templateProcessor->setValue('pembina_organisasi', $request->input('pembina_organisasi'));
        $templateProcessor->setValue('nip_pembina', $request->input('nip_pembina'));
         
        // Memproses input tanggal untuk mendapatkan hari dan tanggal dalam format yang diinginkan
         $inputTanggal = Carbon::parse($request->input('hari_tanggal'));
         $hariTanggal = $inputTanggal->locale('id')->translatedFormat('l / j F Y');
         $templateProcessor->setValue('hari/tanggal', $hariTanggal);
 
         // Mengganti placeholder tanggal pembuatan surat dengan tanggal saat ini
         $tanggalPembuatanSurat = Carbon::now()->locale('id')->translatedFormat('j F Y');
         $templateProcessor->setValue('tanggalPembuatanSurat', $tanggalPembuatanSurat);
       // Mengganti logo di template
        $logoPath = public_path($instansi->file);

      
        // Jika file ditemukan, lanjutkan dengan pengolahan template
        if (file_exists($logoPath)) {
           
            // Menetapkan nilai gambar untuk placeholder 'logo' dalam template
            $templateProcessor->setImageValue('logo', array(
                'path' => $logoPath,
                'width' => 100,  // Lebar dalam satuan piksel
                'height' => 100, // Tinggi dalam satuan piksel
                'ratio' => true,
                'wrappingStyle' => 'infront'  // Menjaga rasio aspek gambar
            ));

             // Menyimpan dokumen yang telah diubah
            $outputPath = storage_path('app/public/' . time() . '_edited_template.docx');
            $templateProcessor->saveAs($outputPath);

            return response()->download($outputPath);
        } else {
            echo "Tidak dapat melanjutkan karena file gambar tidak ditemukan.";
        }

       

       
    }
}
