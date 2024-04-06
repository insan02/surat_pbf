@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
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
        <form action="/suratkeluar/tambah" method="POST" enctype="multipart/form-data">
            <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Tambah Data Surat Keluar</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="penerima">Penerima</label>
                    <select name="penerima" id="penerima" class="form-control bg-light" required>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                    <label for="jenis">Jenis:</label>
                        <input type="text" class="form-control" id="jenis" name="jenis">
                    <label for="file">File:</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                    <label for="keterangan">Keterangan:</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                </div>
                
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> KIRIM</button>
            <a class="btn btn-danger btn-sm" href="index" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
