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
                        <a href="{{ route('nasabah.create') }}"><button class="btn btn-success btn-sm mb-3"><i class="uil uil-plus"></i> Tambah Nasabah</button></a>
                        <table id="table" class="table display cell-border">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Saldo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nasabah as $n)
                                    <tr>
                                        <td>{{ $n->id }}</td>
                                        <td>{{ $n->nama }}</td>
                                        <td>{{ $n->alamat }}</td>
                                        <td>Rp. {{ $n->saldo }}</td>
                                        <td>
                                            <a href="{{ route('nasabah.show', $n->id) }}" class="btn btn-primary btn-sm">View</a>
                                            <a href="{{ route('nasabah.edit', $n->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="{{ route('nasabah.delete', $n->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
                    <div class="card-header">Nasabah Terbaik</div>
                    <div class="card-body">
                        <table id="table2" class="table display cell-border">
                            <thead>
                                <tr>
                                    <th class="col-3">No</th>
                                    <th class="col-6">Nama</th>
                                    <th class="col-3">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_nilai_nasabah as $dnn)
                                    <tr>
                                        <td>{{ $dnn["no"] }}</td>
                                        <td>{{ $dnn["nama"] }}</td>
                                        <td>{{ $dnn["nilai"] }}</td>
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
    new DataTable('#table', {
        layout: {
            topStart: {
                buttons: ['excelHtml5']
            }
        }
    });
    new DataTable('#table2');
</script>
@endsection

