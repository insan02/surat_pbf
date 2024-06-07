<?php

namespace App\Http\Controllers;
use App\SuratKeluar;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Instansi;
use App\User;
use App\Kategori;
use App\Dokumen;

class SuratKeluarController extends Controller
{
    public function index()
    {
        
        // Mendapatkan peran pengguna
        $role = Auth::user()->role;

        // Mengirimkan peran pengguna ke tampilan
        return view('suratkeluar.index', ['role' => $role]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil data penerima dari tabel User, kecuali pengguna yang sedang login
        $users = User::where('id', '<>', $userId)->pluck('name', 'id');

        // Ambil data jenis dari tabel Kategori
        $jenis = Kategori::pluck('nama', 'id');

        // Ambil data file dari tabel Dokumen sesuai dengan user yang sedang login
        $userId = Auth::id();
        $files = Dokumen::where('user_id', $userId)->pluck('nama_dokumen', 'id');

        return view('suratkeluar.create', compact('users', 'jenis', 'files'));
    }

    //function untuk tambah
    public function tambah ()
    {
    
       return redirect('/suratkeluar/index')->with("sukses", "Data Surat Keluar Berhasil Ditambahkan");
    }

    public function edit()
    {
        
        return view('suratkeluar/edit');
    }

    
    public function update ()
    {
        return redirect('suratkeluar/index') ->with('sukses','Data Surat Keluar Berhasil Diedit');
    }

    //function untuk hapus
    public function delete()
    {
    
        return redirect('suratkeluar/index') ->with('sukses','Data Surat Keluar Berhasil Dihapus');
    }
}
