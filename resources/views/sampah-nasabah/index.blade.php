@extends('master-nasabah')
@section('title')
    Sampah
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Bank Sampah Resik
        @endslot
        @slot('title')
            Data Transaksi Sampah
        @endslot
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Saldo Anda</div>
                    <div class="card-body">
                        <h4 class="mb-1 mt-1">Rp. {{ $total_harga }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Total Volume Sampah</div>
                    <div class="card-body">
                        <h4 class="mb-1 mt-1">{{ $total_volume }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sampah</div>
                    <div class="card-body">
                        <table id="table" class="table display cell-border">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Sampah</th>
                                    <th>Kategori Sampah</th>
                                    <th>Quantity</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data_sampah as $ds)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $ds->tanggal_transaksi }}</td>
                                        <td>{{ $ds->sampah }}</td>
                                        <td>{{ $ds->nama_kategori_sampah }}</td>
                                        <td>{{ $ds->quantity }}</td>
                                        <td>{{ $ds->harga }}</td>
                                        {{-- <td>
                                            <a href="{{ route('sampah.show', $s->id) }}" class="btn btn-primary btn-sm">View</a>
                                            <a href="{{ route('sampah.edit', $s->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="{{ route('sampah.delete', $s->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                        </td> --}}
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
    // new DataTable('#table', {
    //     layout: {
    //         topStart: {
    //             buttons: ['excelHtml5']
    //         }
    //     }
    // });
</script>
@endsection

