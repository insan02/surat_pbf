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
        <form action="{{ route('pengguna.update', $data_pengguna->id) }}" method="POST">
            <h3><i class="nav-icon fas fa-user my-1 btn-sm-1"></i> Edit Data Pengguna</h3>
            <hr>
            {{csrf_field()}}
            @method('put')
            <div class="row">
                <div class="col-6">
                    <label for="name">Nama</label>
                    <input name="name" type="text" class="form-control bg-light" id="name" placeholder="Nama"
                        value="{{$data_pengguna->name}}" required>

                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control bg-light" id="email" placeholder="Email"
                        value="{{$data_pengguna->email}}" required>

                    <label for="namaorganisasi">Nama Organisasi</label>
                    <input name="namaorganisasi" type="text" class="form-control bg-light" id="namaorganisasi" placeholder="Nama Organisasi" value="{{$data_pengguna->namaorganisasi}}" required>
                </div>
                <div class="col-6">
                    <label for="jenisorganisasi">Jenis Organisasi</label>
                    <select name="jenisorganisasi" id="jenisorganisasi" class="form-control bg-light" required>
                        <option value="BEM" @if ($data_pengguna->jenisorganisasi == 'BEM') selected @endif>BEM
                        </option>
                        <option value="HIMA" @if ($data_pengguna->jenisorganisasi == 'HIMA') selected @endif>HIMA</option>
                    </select>

                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm "><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="{{ route('pengguna.index') }}" role="button"><i
                    class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
    </div>
</section>
@endsection
