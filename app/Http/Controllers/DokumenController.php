<?php

namespace App\Http\Controllers;

use App\Dokumen;
use App\Instansi;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        // Mengambil dokumen sesuai dengan user yang sedang login
        $dokumen = Dokumen::where('user_id', Auth::id())->get();
        return view('dokumen.index', compact('dokumen'));
    }

    public function create()
    {
        return view('dokumen.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'event' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // Simpan file ke storage
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/public/dokumenpdf/'), $filename);

        // Buat dokumen baru
        Dokumen::create([
            'event' => $request->event,
            'nama_dokumen' => $filename,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dokumen.index')->with('sukses', 'Dokumen berhasil ditambahkan.');
    }

    public function destroy(Dokumen $dokumen)
    {
        // Hapus file dari storage
        Storage::delete('public/dokumenpdf/' . $dokumen->nama_dokumen);

        // Hapus dokumen dari database
        $dokumen->delete();

        return redirect()->route('dokumen.index')->with('sukses', 'Dokumen berhasil dihapus.');
    }

    public function createtemp()
    {

        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil data penerima dari tabel User, kecuali pengguna yang sedang login
        $users = User::where('id', '<>', $userId)->pluck('namaorganisasi', 'id');

        return view('dokumen.createtemp', compact('users'));
    }

    public function editTemplate(Request $request)
    {
        $userId = Auth::id();
        // Ambil semua data user dari tabel user kecuali pengguna yang sedang login
        $users = User::where('id', '<>', $userId)->pluck('namaorganisasi', 'id');
        $instansi = Instansi::where('user_id', $userId)->first();

        // Definisikan variabel $tujuanlist sebelum digunakan
        $tujuanlist = $users;

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

        $tujuanlist = $users;
        $templateProcessor->setValue('Tujuan', view('dokumen.createtemp', compact('tujuanlist')));

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
