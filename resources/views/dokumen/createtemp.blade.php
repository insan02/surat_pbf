@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
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
        <form action="/dokumen/tambahtemp" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope-open-text my-1 btn-sm-1"></i> Tambah Dari Template</h3>
            <hr />
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="template">Pilih Template:</label>
                        <select class="form-control" id="template">
                            <option>Template 1</option>
                            <option>Template 2</option>
                            <option>Template 3</option>
                        </select>
                    <label for="nomor_surat">Nomor Surat:</label>
                        <input type="text" class="form-control" id="nomor_surat">
                    <label for="lampiran">Lampiran:</label>
                        <input type="text" class="form-control" id="lampiran">
                    <label for="pembukaan">Pembukaan:</label>
                        <input type="text" class="form-control" id="pembukaan">
                    <label for="hari_tanggal">Hari/Tanggal:</label>
                        <input type="text" class="form-control" id="hari_tanggal">
                    <label for="jam">Jam:</label>
                        <input type="text" class="form-control" id="jam">
                    <label for="tempat">Tempat:</label>
                        <input type="text" class="form-control" id="tempat">
                    <label for="penutup">Penutup:</label>
                        <input type="text" class="form-control" id="penutup">
                    <label for="nama_ketua">Nama Ketua:</label>
                        <input type="text" class="form-control" id="nama_ketua">
                    <label for="nim_ketua">NIM Ketua:</label>
                        <input type="text" class="form-control" id="nim_ketua">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
