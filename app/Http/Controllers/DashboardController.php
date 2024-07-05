<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use App\Models\Nasabah;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jml_nasabah = count(Nasabah::all());

        $data_pendapatan = DB::select("SELECT detail_transaksi.id_transaksi,detail_transaksi.id_sampah,detail_transaksi.quantity,transaksi.tanggal_transaksi,sampah.harga_satuan FROM detail_transaksi
        LEFT JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id AND transaksi.tanggal_transaksi BETWEEN '31-12-2020' AND '01-01-2022'
        JOIN sampah ON detail_transaksi.id_sampah = sampah.id
        GROUP BY detail_transaksi.id_transaksi,detail_transaksi.id_sampah,detail_transaksi.quantity,transaksi.tanggal_transaksi,sampah.harga_satuan");

        foreach ($data_pendapatan as $dp) {
            $jml_harga[] = $dp->quantity * $dp->harga_satuan;
        }
        $total_pendapatan = array_sum($jml_harga);

        $data_sampah = DetailTransaksi::all();
        foreach ($data_sampah as $ds) {
            $qty[] = $ds->quantity;
        }
        $total_sampah = array_sum($qty);

        return view('Dashboard',compact('jml_nasabah','total_pendapatan','total_sampah'));
    }
}
