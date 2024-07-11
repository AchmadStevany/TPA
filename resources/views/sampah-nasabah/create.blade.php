@extends('master-nasabah')
@section('title')
    Sampah
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Sampah
        @endslot
        @slot('title')
            Tambah
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tambah Sampah</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('sampah-nasabah.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-4">
                                    <label for="tanggal">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="sampah">Nama Sampah</label>
                                    <select name="sampah" id="sampah" class="form-control">
                                        <option value disabled selected>Pilih Sampah</option>
                                        @foreach ($sampah as $s)
                                        <option value="{{ $s->id }}">{{ $s->sampah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="quantity">jumlah sampah</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-3">Tambah</button>
                            <a href="/sampah-nasabah" class="btn btn-secondary btn-sm position-absolute end-0 mt-3 me-3"><i class="uil uil-arrow-left"></i> Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
