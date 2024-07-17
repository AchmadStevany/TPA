@extends('master')
@section('title')
    Transaksi
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Transaksi
        @endslot
        @slot('title')
            Tambah Transaksi
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Transaksi Sampah</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('transaksi.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nasabah">Nasabah</label>
                                    <select class="select2 form-control" name="nasabah" id="nasabah" required>
                                        <option value disabled selected>Pilih Nasabah</option>
                                        @foreach ($nasabah as $n)
                                            <option value="{{ $n->id }}">{{ $n->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="sampah">Sampah</label>
                                    <select class="select2 form-control" name="sampah" id="sampah" required>
                                        <option value disabled selected>Pilih Sampah</option>
                                        @foreach ($sampah as $s)
                                            <option value="{{ $s->id }}">{{ $s->sampah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group col-lg-6">
                                    <label for="qty">Jumlah Sampah</label>
                                    <input type="number" name="qty" id="qty" class="form-control">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-3">Tambah</button>
                            <a href="/sampah" class="btn btn-secondary btn-sm position-absolute end-0 mt-3 me-3"><i class="uil uil-arrow-left"></i> Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
