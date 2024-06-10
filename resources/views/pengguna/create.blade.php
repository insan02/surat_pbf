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
        <form action="{{ route('pengguna.store') }}" method="POST">
            <h3><i class="nav-icon fas fa-user my-1 btn-sm-1"></i> Tambah Data Pengguna</h3>
            <hr>
            {{ csrf_field() }}
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="name">Nama</label>
                        <input name="name" type="text" class="form-control bg-light" id="name" placeholder="Nama Pendek ex: HMSI" value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control bg-light" id="email" placeholder="Email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="namaorganisasi">Nama Organisasi</label>
                        <input name="namaorganisasi" type="text" class="form-control bg-light" id="namaorganisasi" placeholder="Nama Organisasi" value="{{ old('namaorganisasi') }}" required>
                        @if ($errors->has('namaorganisasi'))
                            <span class="text-danger">{{ $errors->first('namaorganisasi') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="jenisorganisasi">Jenis Organisasi</label>
                        <select name="jenisorganisasi" id="jenisorganisasi" class="form-control bg-light" required>
                            <option value="BEM" {{ old('jenisorganisasi') == 'BEM' ? 'selected' : '' }}>BEM</option>
                            <option value="HIMA" {{ old('jenisorganisasi') == 'HIMA' ? 'selected' : '' }}>HIMA</option>
                        </select>
                        @if ($errors->has('jenisorganisasi'))
                            <span class="text-danger">{{ $errors->first('jenisorganisasi') }}</span>
                        @endif
                    </div>
                    
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPAN</button>
            <a class="btn btn-danger btn-sm" href="{{ route('pengguna.index') }}" role="button"><i class="fas fa-undo"></i> BATAL</a>
        </form>
    </div>
</section>
@endsection
