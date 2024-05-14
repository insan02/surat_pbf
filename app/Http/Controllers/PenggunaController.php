<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil data pengguna dengan role "user" saja
        $data_pengguna = User::all();

        return view('pengguna.index', compact('data_pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'namaorganisasi' => 'required',
            'jenisorganisasi' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $pengguna = User::create([
            'name' => $request->name,
            'namaorganisasi' => $request->namaorganisasi,
            'jenisorganisasi' => $request->jenisorganisasi,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'role' => $request->role,
        ]);

        return redirect()->route('pengguna.index')->with('sukses','Data Pengguna Berhasil Disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_pengguna= User::findOrFail($id);
        return view('pengguna.edit', compact('data_pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $pengguna = User::findOrFail($id);

    // Inisialisasi aturan validasi
    $rules = [];

    // Tambahkan aturan validasi untuk nama jika diisi
    if ($request->filled('name')) {
        $rules['name'] = 'required|min:5';
    }

    // Tambahkan aturan validasi untuk email jika diisi
    if ($request->filled('email')) {
        $rules['email'] = 'required|email|unique:users,email,'.$id;
    }


    // Tambahkan aturan validasi untuk role jika diisi
    if ($request->filled('role')) {
        $rules['role'] = 'required';
    }

    // Lakukan validasi
    $this->validate($request, $rules);

    // Siapkan data yang akan diupdate
    $data_pengguna = [];

    // Perbarui data jika input tidak kosong
    if ($request->filled('name')) {
        $data_pengguna['name'] = $request->name;
    }

    if ($request->filled('email')) {
        $data_pengguna['email'] = $request->email;
    }

    if ($request->filled('role')) {
        $data_pengguna['role'] = $request->role;
    }

    if ($request->filled('namaorganisasi')) {
        $data_pengguna['namaorganisasi'] = $request->namaorganisasi;
    }

    if ($request->filled('jenisorganisasi')) {
        $data_pengguna['jenisorganisasi'] = $request->jenisorganisasi;
    }


    // Lakukan pembaruan data
    $pengguna->update($data_pengguna);

    return redirect()->route('pengguna.index')->with('sukses','Data Pengguna Berhasil Di Update');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pengguna = User::findOrFail($id);
            $pengguna->delete();

            return redirect()->route('pengguna.index')->with('sukses','Data Berhasil di Hapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('sukses','Maaf, Masih ada data yang terpaut dengan user ini.');
        }
    }
}
