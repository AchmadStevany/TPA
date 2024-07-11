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
                    <div class="card-header">Kategori Sampah</div>

                    <div class="card-body">
                        <a href="/sampah" class="btn btn-secondary btn-sm mb-3"><i class="uil uil-arrow-left"></i> Kembali</a>
                        <a href="{{ route('kategori_sampah.create') }}" class="btn btn-success btn-sm mb-3"><i class="uil uil-plus"></i> Tambah Kategori</a>

                        <table id="table" class="table display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $k)
                                    <tr>
                                        <td>{{ $k->id }}</td>
                                        <td>{{ $k->nama_kategori_sampah }}</td>
                                        <td>
                                            <a href="{{ route('kategori_sampah.show', $k->id) }}" class="btn btn-primary btn-sm">View</a>
                                            <a href="{{ route('kategori_sampah.edit', $k->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="{{ route('kategori_sampah.delete', $k->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Kategori Sampah Terbaik</div>
                    <div class="card-body">
                        <table id="table2" class="table display cell-border">
                            <thead>
                                <tr>
                                    <th class="col-6">Nama Kategori</th>
                                    <th class="col-3">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_nilai_kategori as $dnk)
                                    <tr>
                                        <td>{{ $dnk["nama"] }}</td>
                                        <td>{{ $dnk["nilai"] }}</td>
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
<script>
    new DataTable('#table2', {
        order: [[1,'desc']]
    });
</script>
@endsection
