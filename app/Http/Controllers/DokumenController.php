<?php

namespace App\Http\Controllers;

use App\Dokumen;
use App\Instansi;
use App\Jabatan;
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
    $path = $file->storeAs('public/dokumenpdf', $filename);

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
        
        // Ambil jenis organisasi pengguna yang sedang login
        $user = User::find($userId);
        $instansi = Instansi::where('user_id', $userId)->first();
        $ketua = Jabatan::where('id_user', $userId)->where('nama_jabatan', 'Ketua')->first();
        $sekretaris = Jabatan::where('id_user', $userId)->where('nama_jabatan', 'Sekretaris')->first();
        $pimpinan = Jabatan::where('id_user', $userId)->where('nama_jabatan', 'Pimpinan')->first();

        if(!$ketua||!$sekretaris||!$pimpinan){
            return redirect()->back()->with('peringatan', 'Silakan isi Jabatan terlebih dahulu dengan lengkap, ketua&Sekre&Pimpinan(pembina).');
         }
        if(!$instansi){
            return redirect()->back()->with('peringatan', 'Silakan isi Profil instansi terlebih dahulu.');
         }
        $jenisOrganisasi = $user->jenisorganisasi;
        // Redirect ke view yang sesuai berdasarkan jenis organisasi
        if ($jenisOrganisasi === "BEM") {
            return view('dokumen.createtempBem', compact('users','user'));
        } else{
            return view('dokumen.createtemp', compact('users','user'));
        }
    }

    public function editTemplate(Request $request)
    {
        $userId = Auth::id();
        // Ambil semua data user dari tabel user kecuali pengguna yang sedang login
        $users = User::where('id', '<>', $userId)->pluck('namaorganisasi', 'id');
        $user = User::find($userId);
        $instansi = Instansi::where('user_id', $userId)->first();
        
        $ketua = Jabatan::where('id_user', $userId)->where('nama_jabatan', 'Ketua')->first();
        $sekretaris = Jabatan::where('id_user', $userId)->where('nama_jabatan', 'Sekretaris')->first();
        $pimpinan = Jabatan::where('id_user', $userId)->where('nama_jabatan', 'Pimpinan')->first();
        // Definisikan variabel $tujuanlist sebelum digunakan
        $tujuanlist = $users;
        if (!$instansi) {
            return response()->json(['message' => 'Instansi tidak ditemukan.'], 404);
        }
        $jenisOrganisasi = $user->jenisorganisasi;

        if ($jenisOrganisasi === "BEM") {
           
            $templatePath = public_path('template_suratBem.docx');
            $templateProcessor = new TemplateProcessor($templatePath);
            $templateProcessor->setValue('NAMA_ORGANISASI', strtoupper($instansi->nama));
            
            // Mengganti teks di template
            $fakultas = $request->input('fakultas');
            if (empty($fakultas)) {
                $templateProcessor->setValue('SEBUTAN', strtoupper($request->input('sebutan')));
                $templateProcessor->setValue('FAKULTAS', "");
            } else {
                $sebutan1 = strtoupper($request->input('sebutan')) . '<w:br />';
                $templateProcessor->setValue('SEBUTAN', $sebutan1);
                $templateProcessor->setValue('FAKULTAS', strtoupper($fakultas));
            
            }
            $templateProcessor->setValue('website', $request->input('website'));
            $templateProcessor->setValue('alamat', ($instansi->alamat));
            $templateProcessor->setValue('email', ($user->email));
            $templateProcessor->setValue('nomor_surat', $request->input('nomor_surat'));
            $templateProcessor->setValue('hal', $request->input('hal'));

            $tujuanlist = $users;
            $templateProcessor->setValue('Tujuan', $request->input('tujuan'));

            $templateProcessor->setValue('nama_acara', $request->input('nama_acara'));
            $templateProcessor->setValue('Jam_Mulai', $request->input('jam_mulai'));
            $templateProcessor->setValue('jam_selesai', $request->input('jam_selesai'));
            $templateProcessor->setValue('lokasi', $request->input('lokasi'));
            $templateProcessor->setValue('nama_ketua', $ketua->nama);
            $templateProcessor->setValue('nim_ketua',  $ketua->nim_nip);
            $templateProcessor->setValue('nama_sekre', $sekretaris->nama);
            $templateProcessor->setValue('nim_sekre',  $sekretaris->nim_nip);
            $templateProcessor->setValue('name', ($user->name));

            $templateProcessor->setValue('Pimpinan', $request->input('jabatan_pimpinan'));
            $templateProcessor->setValue('nama_pimpinan', $pimpinan->nama);
            $templateProcessor->setValue('nip', $pimpinan->nim_nip);

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
                $imageOptions = array(
                    'path' => $logoPath,
                    'wrappingStyle' => 'infront', // Menjaga rasio aspek gambar
                );
            
                // Jika $fakultas tidak kosong, atur ukuran gambar ke 100x100 piksel
                if (!empty($fakultas)) {
                    $imageOptions['width'] = 100;  // Lebar dalam satuan piksel
                    $imageOptions['height'] = 100; // Tinggi dalam satuan piksel
                    $imageOptions['ratio'] = true; // Menjaga rasio aspek gambar
                } else {
                    // Jika $fakultas kosong, atur ukuran gambar kecil
                    $imageOptions['width'] = 90;   // Lebar dalam satuan piksel
                    $imageOptions['height'] = 90;  // Tinggi dalam satuan piksel
                    $imageOptions['ratio'] = true; // Menjaga rasio aspek gambar
                }
            
                $templateProcessor->setImageValue('logo', $imageOptions);
                // Mengganti nama file berdasarkan input user
                $hal = $request->input('hal');
                $tujuan = $request->input('tujuan');
                $namaAcara = $request->input('nama_acara');
                $outputFilename = time() . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $hal) . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $tujuan) . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $namaAcara) . '.docx';
                $outputPath = public_path('storage/dokumenpdf/' . $outputFilename);
                $templateProcessor->saveAs($outputPath);

                Dokumen::create([
                    'event' => $namaAcara,
                    'nama_dokumen' => $outputFilename,
                    'user_id' => Auth::id(),
                ]);

                return response()->download($outputPath);

                
            } else {
                echo "Silahkan upload logo terlebih dahulu di halaman instansi.";
            }
        } else{
        
        $templatePath = public_path('004 - Upgrading - Peminjangan Gedung  (1).docx');
        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValue('nama_organisasi', strtoupper($instansi->nama));

        // Mengganti teks di template
        $templateProcessor->setValue('JURUSAN', strtoupper($request->input('jurusan')));
        $templateProcessor->setValue('FAKULTAS', strtoupper($request->input('fakultas')));
        $templateProcessor->setValue('website', $request->input('website'));
        $templateProcessor->setValue('email', ($instansi->email));
        $templateProcessor->setValue('nomor_surat', $request->input('nomor_surat'));
        $templateProcessor->setValue('hal', $request->input('hal'));

        $tujuanlist = $users;
        $templateProcessor->setValue('Tujuan', $request->input('tujuan'));

        $templateProcessor->setValue('nama_acara', $request->input('nama_acara'));
        $templateProcessor->setValue('Jam_Mulai', $request->input('jam_mulai'));
        $templateProcessor->setValue('jam_selesai', $request->input('jam_selesai'));
        $templateProcessor->setValue('lokasi', $request->input('lokasi'));
        $templateProcessor->setValue('nama_ketua', $ketua->nama);
        $templateProcessor->setValue('nim_ketua',  $ketua->nim_nip);
        $templateProcessor->setValue('nama_sekre', $sekretaris->nama);
        $templateProcessor->setValue('nim_sekre',  $sekretaris->nim_nip);
        $templateProcessor->setValue('pembina_organisasi', $pimpinan->nama);
        $templateProcessor->setValue('nip_pembina', $pimpinan->nim_nip);
        $templateProcessor->setValue('name', ($user->name));
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
            $hal = $request->input('hal');
            $tujuan = $request->input('tujuan');
            $namaAcara = $request->input('nama_acara');
            $outputFilename = time() . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $hal) . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $tujuan) . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $namaAcara) . '.docx';
            $outputPath = public_path('storage/dokumenpdf/' . $outputFilename);
            $templateProcessor->saveAs($outputPath);

            Dokumen::create([
                'event' => $namaAcara,
                'nama_dokumen' => $outputFilename,
                'user_id' => Auth::id(),
            ]);
            return response()->download($outputPath);
            
        } else {
            echo "Silahkan upload logo terlebih dahulu di halaman instansi.";
        }
    }
    }
}
