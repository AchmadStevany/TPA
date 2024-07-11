@extends('master')
@section('title')
    Edit Sampah
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Sampah
        @endslot
        @slot('title')
            Edit Sampah
        @endslot
    @endcomponent
    @foreach ($nama_kategori as $nk)
        @php
            $idkat = $nk->id;
            $namakat = $nk->nama_kategori_sampah;
        @endphp
    @endforeach
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Sampah</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('sampah.update', $sampah->id) }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nama_sampah">Nama Sampah</label>
                                    <input type="text" name="nama_sampah" id="nama_sampah" class="form-control" value="{{ $sampah->sampah }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="kategori_sampah">Kategori Sampah</label>
                                    <select class="select2 form-control" name="kategori_sampah" id="kategori_sampah" required>
                                        <option value="{{ $idkat }}">{{ $namakat }}</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_kategori_sampah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group col-lg-6">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" name="satuan" id="satuan" class="form-control" value="{{ $sampah->satuan }}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="harga_satuan">Harga Satuan</label>
                                    <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" value="{{ $sampah->harga_satuan }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
                            <a href="/sampah" class="btn btn-secondary btn-sm position-absolute end-0 mt-3 me-3"><i class="uil uil-arrow-left"></i> Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
