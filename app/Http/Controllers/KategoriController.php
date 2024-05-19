<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Imports\KategoriImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert; 

class KategoriController extends Controller
{
    public function index()
    {
        $data_kategori = \App\Kategori::all();
        return view('kategori.index',['data_kategori'=> $data_kategori]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        return view('kategori/create');
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
        try {
            $request->validate([
                'nama' => 'unique:kategori|min:5',
                'uraian' => 'min:5',
            ]);
            $kategori = new Kategori();
            $kategori->nama = $request->input('nama');
            $kategori->uraian = $request->input('uraian');
            $kategori->save();

            // Menggunakan SweetAlert untuk menampilkan notifikasi sukses
            Alert::success('Berhasil', 'Data Kategori Berhasil Ditambahkan');

            return redirect('/kategori/index')->with("sukses", "Data Kategori Berhasil Ditambahkan");
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Menampilkan pesan SweetAlert untuk kesalahan validasi
            $errors = $e->validator->errors()->all();
            Alert::error('Gagal', implode( $errors));

            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    //function untuk masuk ke view edit
    public function edit ($id_kategori)
    {
        $kategori = \App\Kategori::find($id_kategori);
        return view('kategori/edit',['kategori'=>$kategori]);
    }
    public function update (Request $request, $id_kategori)
    {
        $request->validate([
            'nama' => 'min:5',
            'uraian' => 'min:5',
        ]);
        $kategori = \App\Kategori::find($id_kategori);
        $kategori->update($request->all());
        $kategori->save();
        return redirect('kategori/index') ->with('sukses','Data kategori Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_kategori)
    {
        $kategori=\App\Kategori::find($id_kategori);
        $kategori->delete();
        return redirect('kategori/index') ->with('sukses','Data kategori Berhasil Dihapus');
    }

    //function untuk import excel
    public function import(){
        // Excel::import(new KlasifikasiImport, 'data_klasifikasi.xls');
        Excel::import(new KategoriImport)->import('data_kategori.xls', null, \Maatwebsite\Excel\Excel::XLS);
        return redirect('kategori/index')->with('sukses', 'Import kategori Berhasil');

        // Excel::import(new ImportKlasifikasi,$request->file('data_klasifikasi'));
        // return back()->with('sukses','Import Klasifikasi Sukses');
        // // dd($request->all());
    }
}
