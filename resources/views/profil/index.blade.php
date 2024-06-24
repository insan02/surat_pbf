@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px;">
    <div class="box">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Profil</h3>
                <hr />
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-3">
                    <h5><label for="nama">Nama</label></h5>
                </div>
                <div class="col-9">
                    <h5><label>: {{ auth()->user()->name }}</label></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <h5><label for="email">Email</label></h5>
                </div>
                <div class="col-9">
                    <h5><label>: {{ auth()->user()->email }}</label></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <h5><label for="role">Role</label></h5>
                </div>
                <div class="col-9">
                    <h5><label>: {{ auth()->user()->role }}</label></h5>
                </div>
            </div>

            <div class="col-12 text-center mt-4">
                <a class="btn btn-primary" href="{{ route('profil.editPassword') }}" role="button">
                    <i class="fas fa-edit"></i> Edit Password
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
