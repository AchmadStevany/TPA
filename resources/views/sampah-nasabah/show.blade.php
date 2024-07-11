@extends('master')
@section('title')
    Detail Sampah
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Sampah
        @endslot
        @slot('title')
            Detail Sampah
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Detail Sampah</div>

                    <div class="card-body">
                        <p><strong>Nama Sampah:</strong> {{ $sampah->sampah }}</p>
                        <p><strong>Kategori:</strong> {{ $sampah->id_kategori_sampah }}</p>
                        <p><strong>Satuan:</strong> {{ $sampah->satuan }}</p>
                        <p><strong>Harga Satuan:</strong> {{ $sampah->harga_satuan }}</p>
                        <a href="/sampah" class="btn btn-secondary btn-sm position-absolute end-0"><i class="uil uil-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
