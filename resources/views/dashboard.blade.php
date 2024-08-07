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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.50.0/apexcharts.min.css" integrity="sha512-YEwcgX5JXVXKtpXI4oXqJ7GN9BMIWq1rFa+VWra73CVrKds7s+KcOfHz5mKzddIOLKWtuDr0FzlTe7LWZ3MTXw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-trash-alt" style="font-size: 40px"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 mt-1">Total Sampah</h5>
                        <p class="text-muted mb-0">Dalam tahun ini</p>
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
                        <p class="text-muted mb-0">Dalam tahun ini</p>
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
                        <p class="text-muted mb-0">Dalam tahun ini</p>
                        <h4 class="mb-1 mt-1">$<span data-plugin="counterup">{{ $total_pendapatan }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-analytics" style="font-size: 40px"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 mt-1">Tahun 2021</h5>
                        <a href="/dashboard2022" class="mb-1 mt-1">Tahun Selanjutnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">Nasabah Terbaik</div>
                <div class="card-body">
                    <table id="table2" class="table display cell-border">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-2">Nama</th>
                                <th class="col-2">Alamat</th>
                                <th class="col-2">Volume Sampah</th>
                                <th class="col-2">Banyak Sampah</th>
                                <th class="col-2">Total Pendapatan</th>
                                <th class="col-1">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data_nasabah_terbaik as $dnn)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dnn["nama"] }}</td>
                                    <td>{{ $dnn["alamat"] }}</td>
                                    <td>{{ $dnn["volume"] }}</td>
                                    <td>{{ $dnn["jenis"] }}</td>
                                    <td>{{ $dnn["pendapatan"] }}</td>
                                    <td>{{ $dnn["nilai"] }}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.50.0/apexcharts.min.js" integrity="sha512-h3DSSmgtvmOo5gm3pA/YcDNxtlAZORKVNAcMQhFi3JJgY41j9G06WsepipL7+l38tn9Awc5wgMzJGrUWaeUEGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var options = {
          series: [{
          name: 'Sampah',
          data: @json($data_jml_sampah),
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },

        xaxis: {
          categories: @json($data_kategori),
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: true
          },
          axisTicks: {
            show: true,
          },
          labels: {
            show: true,
          }

        },
        title: {
          text: 'Jumlah sampah per kategori',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

    new DataTable('#table2', {
        // order: [[5,'desc']]
    });
</script>
@endsection
