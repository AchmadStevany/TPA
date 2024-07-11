@extends('master-nasabah')
@section('title')
    Dashboard
@endsection
@section('content')
    @component('layouts.breadcrumb')
        @slot('pagetitle')
            Bank Sampah Resik
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">Nasabah Terbaik</div>
                <div class="card-body">
                    <table id="table" class="table display cell-border">
                        <thead>
                            <tr>
                                <th class="col-6">Nama</th>
                                <th class="col-3">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_nilai_nasabah as $dnn)
                                <tr>
                                    <td>{{ $dnn["nama"] }}</td>
                                    <td>{{ $dnn["nilai"] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
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
@endsection
@section('script')
<script>
    new DataTable('#table', {
        order: [[1,'desc']]
    });
    new DataTable('#table2', {
        order: [[1,'desc']]
    });
</script>
@endsection
