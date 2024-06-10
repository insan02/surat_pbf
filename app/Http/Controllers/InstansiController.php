<?php
namespace App\Http\Controllers;

use App\Instansi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class InstansiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Instansi $instansi)
    {
        $userId = Auth::id();
        $instansi = Instansi::where('user_id', $userId)->get();
        return view('instansi.index', compact('instansi'));
    }

    public function create()
    {
        $userId = Auth::id();
        $user =  User::find($userId);
        return view('instansi.create', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required',
            'alamat'   => 'required',
            'pimpinan' => 'required',
            'email'    => 'required|email',
            'file'     => 'file|mimes:jpeg,png|max:2048',
        ]);

        $filelogo = $request->file;
        $newlogo = time() . $filelogo->getClientOriginalName();

        // Ensure user is authenticated and set the user_id
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('instansi.index')->with('error', 'User is not authenticated');
        }

        $instansi = Instansi::create([
            'nama'     => $request->nama,
            'alamat'   => $request->alamat,
            'pimpinan' => $request->pimpinan,
            'email'    => $request->email,
            'file'     => 'uploads/logo/' . $newlogo,
            'user_id'  => $userId, // Set user_id to the ID of the logged-in user
        ]);

        $filelogo->move('uploads/logo/', $newlogo);
        $post = User::findOrFail($userId);
        $post_data = [
            'namaorganisasi' =>$request->nama,
            'email'    => $request->email,
        ];
        $post -> update($post_data);
        return redirect()->route('instansi.index')->with('sukses', 'Data Instansi Berhasil Disimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        return view('instansi.edit', compact('instansi'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama'     => 'required',
            'alamat'   => 'required',
            'pimpinan' => 'required',
            'email'    => 'required|email',
            'file'     => 'file|mimes:jpeg,png|max:2048',
        ]);

        $post = Instansi::findOrFail($id);

        $post_data = [
            'nama'     => $request->nama,
            'alamat'   => $request->alamat,
            'pimpinan' => $request->pimpinan,
            'email'    => $request->email,
        ];

        if ($request->has('file')) {
            $filelogo = $request->file;
            $newlogo = time() . $filelogo->getClientOriginalName();
            $filelogo->move('uploads/logo/', $newlogo);
            $post_data['file'] = 'uploads/logo/' . $newlogo;
        }

        $post->update($post_data);

        return redirect()->route('instansi.index')->with('sukses', 'Data Instansi Berhasil di Update');
    }

    public function destroy($id)
    {
        //
    }
}
