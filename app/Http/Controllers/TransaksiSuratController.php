<?php

namespace App\Http\Controllers;

use App\TransaksiSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Kategori;
use App\Dokumen;
use App\User;
use App\Mail\SuratKeluarNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class TransaksiSuratController extends Controller
{
    public function indexSuratKeluar()
    {
        $userId = Auth::id();

        $transaksiSurats = TransaksiSurat::with('user', 'kategori', 'dokumen')
                                         ->where('user_id', $userId)
                                         ->get();

        return view('suratkeluar.index', compact('transaksiSurats'));
    }

    public function createSuratKeluar()
    {
        $userId = Auth::id();
        $users = User::where('id', '<>', $userId)->pluck('namaorganisasi', 'id');
        $jenis = Kategori::pluck('nama', 'id');
        $files = Dokumen::where('user_id', $userId)->pluck('nama_dokumen', 'id');

        return view('suratkeluar.create', compact('users', 'jenis', 'files'));
    }

    public function tambahSuratKeluar(Request $request)
{
    $request->validate([
        'penerima' => 'required',
        'jenis' => 'required',
        'file' => 'required',
        'keterangan' => 'nullable|string',
    ]);

    $defaultBalasan = '-';

    $transaksiSurat = TransaksiSurat::create([
        'user_id' => Auth::id(),
        'kategori_id' => $request->jenis,
        'dokumen_id' => $request->file,
        'penerima' => $request->penerima,
        'balasan' => $defaultBalasan,
        'keterangan' => $request->keterangan,
    ]);

    // Ambil penerima surat
    $penerima = User::findOrFail($request->penerima);

    // Ambil informasi dokumen terkait
    $dokumen = Dokumen::findOrFail($request->file);
    $namaFile = $dokumen->nama_dokumen;
    $pdfPath = storage_path('app/public/dokumenpdf/' . $namaFile);

    // Kirim email notifikasi ke penerima dengan lampiran PDF
    Mail::to($penerima->email)->send(new SuratKeluarNotification(
        Auth::user()->namaorganisasi,
        $transaksiSurat->kategori->nama,
        $transaksiSurat->keterangan,
        $pdfPath, // Sertakan path ke file PDF di konstruktor mailable class
        $namaFile // Sertakan nama file untuk digunakan sebagai nama lampiran
    ));

    return redirect('/suratkeluar/index')->with("sukses", "Data Surat Keluar Berhasil Ditambahkan");
}

    public function editSuratKeluar($id)
{
    $transaksiSurat = TransaksiSurat::findOrFail($id);
    $users = User::pluck('namaorganisasi', 'id');
    $jenis = Kategori::pluck('nama', 'id');
    $files = Dokumen::pluck('nama_dokumen', 'id');

    return view('suratkeluar.edit', compact('transaksiSurat', 'users', 'jenis', 'files'));
}

public function updateSuratKeluar(Request $request, $id)
{
    $request->validate([
        'penerima' => 'required',
        'jenis' => 'required',
        'file' => 'nullable|exists:dokumen,id', // Validasi file opsional, harus ada di tabel dokumens
        'keterangan' => 'nullable|string',
    ]);

    $transaksiSurat = TransaksiSurat::findOrFail($id);

    // Handle file update if a new file is selected
    if ($request->filled('file')) {
        $dokumen = Dokumen::findOrFail($request->file);

        // Hapus file lama jika ada
        if ($transaksiSurat->dokumen) {
            $oldFile = public_path('storage/public/dokumenpdf/' . $transaksiSurat->dokumen->nama_dokumen);
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        // Perbarui dokumen_id dalam rekaman transaksiSurat
        $transaksiSurat->dokumen_id = $dokumen->id;
    }

    // Perbarui bidang lainnya
    $transaksiSurat->kategori_id = $request->jenis;
    $transaksiSurat->penerima = $request->penerima;
    $transaksiSurat->keterangan = $request->keterangan;
    $transaksiSurat->save(); // Simpan perubahan

    return redirect('/suratkeluar/index')->with('sukses', 'Data Surat Keluar Berhasil Diedit');
}


    public function deleteSuratKeluar($id)
    {
        $transaksiSurat = TransaksiSurat::findOrFail($id);
        $transaksiSurat->delete();

        return redirect('/suratkeluar/index')->with('sukses', 'Data Surat Keluar Berhasil Dihapus');
    }

    public function tampilSuratKeluar($id)
{
    $transaksiSurat = TransaksiSurat::findOrFail($id);
    $namaFile = $transaksiSurat->dokumen->nama_dokumen;
    $filePath = public_path('storage/dokumenpdf/' . $namaFile);

    if (!file_exists($filePath)) {
        abort(404, 'File not found.');
    }

    return response()->download($filePath, $namaFile);
}

public function indexSuratMasuk()
{
    $userId = Auth::id();

    // Ambil daftar surat yang dihapus dari sesi
    $deletedSuratIds = session()->get('deleted_surat_ids', []);

    $suratMasuks = TransaksiSurat::with('user', 'kategori', 'dokumen')
                                 ->where('penerima', $userId)
                                 ->whereNotIn('id', $deletedSuratIds) // Tambahkan kondisi ini
                                 ->get();

    return view('suratmasuk.index', compact('suratMasuks'));
}


public function tampilSuratMasuk($id)
{
    $transaksiSurat = TransaksiSurat::findOrFail($id);
    $namaFile = $transaksiSurat->dokumen->nama_dokumen;
    $filePath = public_path('storage/dokumenpdf/' . $namaFile);

    if (!file_exists($filePath)) {
        abort(404, 'File not found.');
    }

    return response()->download($filePath, $namaFile);
}

    public function reply(Request $request)
    {
        $request->validate([
            'suratmasuk_id' => 'required|exists:transaksisurat,id',
            'replyText' => 'required|string',
        ]);

        $transaksiSurat = TransaksiSurat::findOrFail($request->suratmasuk_id);
        $transaksiSurat->balasan = $request->replyText;
        $transaksiSurat->save();

        return redirect()->route('suratmasuk.index')->with('sukses', 'Balasan berhasil dikirim.');
    }

    public function deleteSuratMasuk($id)
{
    $transaksiSurat = TransaksiSurat::findOrFail($id);

    // Lakukan pengecekan jika user yang sedang login adalah penerima surat atau memiliki otorisasi untuk menghapus
    if ($transaksiSurat->penerima != Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    // Ambil daftar surat yang dihapus dari sesi
    $deletedSuratIds = session()->get('deleted_surat_ids', []);

    // Tambahkan ID surat yang dihapus ke dalam daftar
    $deletedSuratIds[] = $id;

    // Simpan daftar yang diperbarui kembali ke sesi
    session()->put('deleted_surat_ids', $deletedSuratIds);

    return redirect()->route('suratmasuk.index')->with('sukses', 'Surat masuk berhasil dihapus dari tampilan.');
}

    
    

}

