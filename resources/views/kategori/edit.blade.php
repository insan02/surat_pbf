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
        <form action="/kategori/{{$kategori->id}}/update" method="POST">
            <h3><i class="nav-icon fas fa-layer-group my-1 btn-sm-1"></i> Edit kategori</h3>
            <hr>
            {{csrf_field()}}
            <div class="row">
                <div class="col-6">
                    <label for="nama">Nama</label>
                    <input name="nama" type="text" class="form-control bg-light" id="nama"
                        placeholder="Nama kategori" value="{{$kategori->nama}}" required>
                </div>
                <div class="col-6">
                    <label for="uraian">Uraian</label>
                    <textarea name="uraian" class="form-control bg-light" id="uraian" rows="3"
                        placeholder="Uraian kategori" value="{{$kategori->uraian}}"
                        required>{{$kategori->uraian}}</textarea>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="/kategori/index" role="button"><i class="fas fa-undo"></i>
                BATAL</a>
        </form>
    </div>
</section>
@endsection
