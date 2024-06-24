<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman profil
    public function index()
    {
        return view('profil.index');
    }

    // Menampilkan halaman edit password
    public function editPassword()
    {
        return view('profil.edit');
    }

    // Memproses perubahan password
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',      // harus ada huruf kecil
                'regex:/[A-Z]/',      // harus ada huruf besar
                'regex:/[0-9]/',      // harus ada angka
            ],
            'new_password_confirmation' => 'required|min:8|same:new_password',
        ], [
            'new_password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'new_password.regex' => 'Password baru harus mengandung setidaknya satu huruf besar, satu huruf kecil, dan satu angka.',
            'new_password_confirmation.same' => 'Konfirmasi password baru harus sama dengan password baru.',
        ]);

        // Memeriksa apakah password lama sesuai
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        // Memperbarui password
        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('profil.index')->with('success', 'Password berhasil diubah.');
    }
}
