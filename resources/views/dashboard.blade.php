@extends('master')
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
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-trash-alt" style="font-size: 40px"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 mt-1">Total Sampah</h5>
                        <p class="text-muted mb-0">Dalam bulan ini</p>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $total_sampah }}</span> Kg</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-user-circle" style="font-size: 40px"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 mt-1">Akun Pengguna</h5>
                        <p class="text-muted mb-0">Dalam bulan ini</p>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ $jml_nasabah }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-usd-circle" style="font-size: 40px"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 mt-1">Total Pemasukan</h5>
                        <p class="text-muted mb-0">Dalam bulan ini</p>
                        <h4 class="mb-1 mt-1">$<span data-plugin="counterup">{{ $total_pendapatan }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
