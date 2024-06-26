@extends('layouts.master')

@section('content')
    <section class="content card" style="padding: 10px 10px 10px 10px">
        <div class="box">
            @if (session('sukses'))
                <div class="alert alert-success" role="alert">
                    {{ session('sukses') }}
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
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-6">

                        <label for="jurusan">Jurusan:</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" required>

                        <label for="fakultas">Fakultas:</label>
                        <input type="text" class="form-control" id="fakultas" name="fakultas" required>

                        <label for="website">Website:</label>
                        <input type="text" class="form-control" id="website" name="website" required>

                        <label for="nomor_surat">Nomor Surat:</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required>

                        <label for="hal">Hal:</label>
                        <input type="text" class="form-control" id="hal" name="hal" required>

                        <label for="tujuan">Tujuan:</label>
                        <select class="form-control" id="tujuan" name="tujuan" required>
                            <option value="">Pilih Tujuan</option>

                            @foreach ($users as $id => $namaorganisasi)
                                <option value="{{ $id }}">{{ $namaorganisasi }}</option>
                            @endforeach
                        </select>

                        <label for="nama_acara">Nama Acara:</label>
                        <input type="text" class="form-control" id="nama_acara" name="nama_acara" required>

                        <label for="jam_mulai">Jam Mulai:</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>

                        <label for="jam_selesai">Jam Selesai:</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>

                        <label for="lokasi">Lokasi:</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" required>

                        <label for="hari_tanggal">Hari/Tanggal:</label>
                        <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal" required>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
                <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
            </form>
        </div>
    </section>
@endsection
