@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('sukses') }}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h3><i class="nav-icon fas fa-envelope my-1 btn-sm-1"></i> Template</h3>
                <h5> Berikut contoh default template surat :</h5>
                <h5 style="color: red">Template yang disediakan hanya untuk undangan</h5>
        <embed id="pdfViewer" src="{{ route('pdf-viewer') }}" type="application/pdf" width="100%" height="600px" style="border:1px solid black;">
            </div>
        </div>
    </div>
</section>

@endsection
