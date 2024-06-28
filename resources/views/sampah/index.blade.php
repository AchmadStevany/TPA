@extends('master')
@section('title')
    Product
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Bank Sampah Resik
        @endslot
        @slot('title')
            Sampah
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sampah</div>
                    <div class="card-body">
                        <a href="{{ route('sampah.create') }}"><button class="btn btn-success btn-sm mb-3"><i class="uil uil-plus"></i> Tambah Sampah</button></a>
                        <a href="/kategorisampah"><button class="btn btn-primary btn-sm mb-3"><i class="uil uil-archive"></i> Kategori Sampah</button></a>
                        <table id="table" class="table display cell-border">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Kategori Sampah</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sampah as $s)
                                    <tr>
                                        <td>{{ $s->id }}</td>
                                        <td>{{ $s->sampah }}</td>
                                        <td>{{ $s->id_kategori_sampah }}</td>
                                        <td>{{ $s->satuan }}</td>
                                        <td>{{ $s->harga_satuan }}</td>
                                        <td>
                                            <a href="{{ route('sampah.show', $s->id) }}" class="btn btn-primary btn-sm">View</a>
                                            <a href="{{ route('sampah.edit', $s->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="{{ route('sampah.delete', $s->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
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

