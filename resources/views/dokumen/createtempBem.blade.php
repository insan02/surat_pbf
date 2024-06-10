@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('edit-template') }}" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Tambah Dari Template</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
      
                    <label for="jurusan">Jurusan:</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan">

                    <label for="fakultas">Fakultas:</label>
                    <input type="text" class="form-control" id="fakultas" name="fakultas">

                    <label for="website">Website:</label>
                    <input type="text" class="form-control" id="website" name="website">

                    <label for="nomor_surat">Nomor Surat:</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat">

                    <label for="hal">Hal:</label>
                    <input type="text" class="form-control" id="hal" name="hal">

                    <label for="tujuan">Tujuan:</label>
                    <select class="form-control" id="tujuan" name="tujuan">
                        @foreach($users as $id => $namaorganisasi)
                            <option value="{{ $id }}">{{ $namaorganisasi }}</option>
                        @endforeach
                    </select>

                    <label for="nama_acara">Nama Acara:</label>
                    <input type="text" class="form-control" id="nama_acara" name="nama_acara">

                    <label for="jam_mulai">Jam Mulai:</label>
                    <input type="text" class="form-control" id="jam_mulai" name="jam_mulai">

                    <label for="jam_selesai">Jam Selesai:</label>
                    <input type="text" class="form-control" id="jam_selesai" name="jam_selesai">

                    <label for="lokasi">Lokasi:</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi">

                    <label for="nama_ketua">Nama Ketua:</label>
                    <input type="text" class="form-control" id="nama_ketua" name="nama_ketua">

                    <label for="nim_ketua">NIM Ketua:</label>
                    <input type="text" class="form-control" id="nim_ketua" name="nim_ketua">

                    <label for="nama_sekre">Nama Sekretaris:</label>
                    <input type="text" class="form-control" id="nama_sekre" name="nama_sekre">

                    <label for="nim_sekre">NIM Sekretaris:</label>
                    <input type="text" class="form-control" id="nim_sekre" name="nim_sekre">

                    <label for="pembina_organisasi">Pembina Organisasi:</label>
                    <input type="text" class="form-control" id="pembina_organisasi" name="pembina_organisasi">

                    <label for="nip_pembina">NIP Pembina:</label>
                    <input type="text" class="form-control" id="nip_pembina" name="nip_pembina">

                    {{-- <label for="logo">Unggah Logo:</label>
                    <input type="file" class="form-control" id="logo" name="logo"> --}}

                    <label for="hari_tanggal">Hari/Tanggal:</label>
                    <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection
