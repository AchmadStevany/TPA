@extends('master')
@section('title')
    Nasabah
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Bank Sampah Resik
        @endslot
        @slot('title')
            Nasabah
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nasabah</div>
                    <div class="card-body">
                        {{-- <a href="{{ route('sampah.create') }}"><button class="btn btn-success btn-sm mb-3"><i class="uil uil-plus"></i> Tambah Sampah</button></a> --}}
                        <table id="table" class="table display cell-border">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nasabah as $n)
                                    <tr>
                                        <td>{{ $n->id }}</td>
                                        <td>{{ $n->nama }}</td>
                                        <td>{{ $n->alamat }}</td>
                                        <td>Rp. {{ $n->saldo }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

