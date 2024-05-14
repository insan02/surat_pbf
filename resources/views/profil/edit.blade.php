@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px;">
    <div class="box">
        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
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
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-edit my-1 btn-sm-1"></i> Edit Password</h3>
                <hr />
            </div>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('update-password') }}">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <h5><label for="current_password">Password Lama</label></h5>
                    </div>
                    <div class="col-9">
                        <input type="password" id="current_password" name="current_password" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <h5><label for="new_password">Password Baru</label></h5>
                    </div>
                    <div class="col-9">
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <h5><label for="new_password_confirmation">Konfirmasi Password Baru</label></h5>
                    </div>
                    <div class="col-9">
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                    </div>
                </div>
                @if(session('error_min_length'))
                <div class="alert alert-danger mt-3" role="alert">
                    {{ session('error_min_length') }}
                </div>
                @endif
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
