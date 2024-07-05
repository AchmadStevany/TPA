@extends('master')
@section('title')
    Detail Nasabah
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Nasabah
        @endslot
        @slot('title')
            Detail Nasabah
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Detail Nasabah</div>

                    <div class="card-body">
                        <p><strong>Nama Nasabah:</strong> {{ $nasabah->nama }}</p>
                        <p><strong>Alamat:</strong> {{ $nasabah->alamat }}</p>
                        <p><strong>Saldo:</strong> {{ $nasabah->saldo }}</p>
                        <a href="/nasabah" class="btn btn-secondary btn-sm position-absolute end-0"><i class="uil uil-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
