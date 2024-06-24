@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Jabatan</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('jabatan.update', $jabatan->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="id_user">User</label>
                            <select id="id_user" name="id_user" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $jabatan->id_user ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nama_jabatan">Nama Jabatan</label>
                            <input type="text" id="nama_jabatan" name="nama_jabatan" class="form-control" value="{{ $jabatan->nama_jabatan }}" required>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="{{ $jabatan->nama }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
