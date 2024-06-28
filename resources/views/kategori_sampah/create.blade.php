@extends('master')
@section('title')
    Kategori Sampah
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Kategori Sampah
        @endslot
        @slot('title')
            Tambah
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah Kategori Sampah</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('kategori_sampah.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nama_kategori_sampah">Nama Kategori Sampah</label>
                                <input type="text" class="form-control" id="nama_kategori_sampah" name="nama_kategori_sampah" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-3">Tambah</button>
                            <a href="/kategorisampah" class="btn btn-secondary btn-sm position-absolute end-0 mt-3 me-3"><i class="uil uil-arrow-left"></i> Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
