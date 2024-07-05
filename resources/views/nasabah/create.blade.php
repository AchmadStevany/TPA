@extends('master')
@section('title')
    Nasabah
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Nasabah
        @endslot
        @slot('title')
            Tambah
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah Nasabah</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('nasabah.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nama_nasabah">Nama Nasabah</label>
                                    <input type="text" name="nama_nasabah" id="nama_nasabah" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="alamat">Alamat Nasabah</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-3">Tambah</button>
                            <a href="/nasabah" class="btn btn-secondary btn-sm position-absolute end-0 mt-3 me-3"><i class="uil uil-arrow-left"></i> Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
