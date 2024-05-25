<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordEmail;
use Illuminate\Support\Str;

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
        $data_pengguna = User::where('role', 'user')->get();

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
        'name' => 'required|unique:users,name',
        'namaorganisasi' => 'required|unique:users,namaorganisasi',
        'jenisorganisasi' => 'required',
        'email' => [
            'required',
            'unique:users,email',
            'email',
            'regex:/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,6}$/'
        ],
    ], [
        'name.unique' => 'Nama pengguna sudah ada.',
        'namaorganisasi.unique' => 'Nama organisasi sudah ada.',
        'email.unique' => 'Email sudah ada.',
        'email.regex' => 'Alamat email tidak valid.',
    ]);

    // Generate random password
    $password = Str::random(8); // generate random 8 characters password

    $pengguna = User::create([
        'name' => $request->name,
        'namaorganisasi' => $request->namaorganisasi,
        'jenisorganisasi' => $request->jenisorganisasi,
        'email' => $request->email,
        'password' => Hash::make($password), // Hash the password
        'role' => 'user',
    ]);

    // Kirim email dengan password
    Mail::to($request->email)->send(new PasswordEmail($password)); // assuming you have created PasswordEmail mailable

    return redirect()->route('pengguna.index')->with('sukses', 'Data Pengguna Berhasil Ditambah');
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
    public function tesemail(){
        Mail::to("aanalamin246@gmail.com")->send(new PasswordEmail);
        return '<h1>Sukses</h1>';
    }
}
