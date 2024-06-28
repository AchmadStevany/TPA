@extends('master')
@section('title')
    Kategori Sampah
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Bank Sampah Resik
        @endslot
        @slot('title')
            Kategori Sampah
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Detail Kategori Sampah</div>

                    <div class="card-body">
                        <p><strong>Nama Kategori:</strong> {{ $kategori->nama_kategori_sampah }}</p>
                        <a href="/kategorisampah" class="btn btn-secondary btn-sm position-absolute end-0"><i class="uil uil-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
