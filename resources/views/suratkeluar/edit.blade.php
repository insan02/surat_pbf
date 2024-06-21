@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px;">
    <div class="box">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('suratkeluar.update', $transaksiSurat->id) }}" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Edit Data Surat Keluar</h3>
            <hr>
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <label for="penerima">Penerima</label>
                    <select name="penerima" id="penerima" class="form-control bg-light" required>
                        <option value="">Pilih Penerima</option>
                        @foreach($users as $id => $namaorganisasi)
                        <option value="{{ $id }}" {{ $transaksiSurat->penerima == $id ? 'selected' : '' }}>{{ $namaorganisasi }}</option>
                        @endforeach
                    </select>

                    <label for="jenis">Jenis</label>
                    <select name="jenis" id="jenis" class="form-control bg-light" required>
                        <option value="">Pilih Jenis</option>
                        @foreach($jenis as $id => $nama)
                        <option value="{{ $id }}" {{ $transaksiSurat->kategori_id == $id ? 'selected' : '' }}>{{ $nama }}</option>
                        @endforeach
                    </select>

                    <label for="file">File</label>
                    @if($transaksiSurat->dokumen)
                    <div class="mb-2">
                        <a href="{{ asset('storage/public/dokumenpdf/' . $transaksiSurat->dokumen->nama_dokumen) }}" target="_blank">Lihat File Saat Ini</a>
                    </div>
                    @endif
                    <select name="file" id="file" class="form-control bg-light" required>
                        <option value="">Pilih File</option>
                        @foreach($files as $id => $nama)
                        <option value="{{ $id }}" {{ $transaksiSurat->dokumen_id == $id ? 'selected' : '' }}>{{ $nama }}</option>
                        @endforeach
                    </select>

                    <label for="keterangan">Keterangan:</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $transaksiSurat->keterangan }}">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="{{ route('suratkeluar.index') }}" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection
