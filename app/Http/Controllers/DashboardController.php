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
        LEFT JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id AND transaksi.tanggal_transaksi BETWEEN '2020-12-31' AND '2022-01-01'
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

        $data_grafik = DB::select("SELECT COUNT(sampah.sampah) as jml_sampah, kategori_sampah.nama_kategori_sampah FROM sampah
        JOIN kategori_sampah ON sampah.id_kategori_sampah = kategori_sampah.id
        GROUP BY kategori_sampah.nama_kategori_sampah");

        foreach ($data_grafik as $dg) {
            $data_jml_sampah[] = $dg->jml_sampah;
            $data_kategori[] = $dg->nama_kategori_sampah;
        }

        $nasabah = DB::select("SELECT transaksi.id_nasabah, nasabah.nama, nasabah.saldo FROM transaksi
        RIGHT JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id
        JOIN nasabah ON nasabah.id = transaksi.id_nasabah
        JOIN sampah ON sampah.id = detail_transaksi.id_sampah
        GROUP BY transaksi.id_nasabah, nasabah.nama");

        $data_banyak_jenis_sampah = DB::select("SELECT transaksi.id_nasabah, nasabah.nama, COUNT(DISTINCT sampah.id_kategori_sampah) as banyak_jenis_sampah FROM transaksi
        RIGHT JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id
        JOIN nasabah ON nasabah.id = transaksi.id_nasabah
        JOIN sampah ON sampah.id = detail_transaksi.id_sampah
        GROUP BY transaksi.id_nasabah, nasabah.nama");

        $data_volume_sampah = DB::select("SELECT transaksi.id_nasabah, nasabah.nama, SUM(detail_transaksi.quantity) as volume FROM transaksi
        RIGHT JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id
        JOIN nasabah ON nasabah.id = transaksi.id_nasabah
        GROUP BY transaksi.id_nasabah, nasabah.nama");

        foreach ($nasabah as $nsb) {
            if ($nsb->saldo >= 100000) {
                $nilai_jual[] = 5;
            } elseif ($nsb->saldo <= 99000 and $nsb->saldo >= 70000 ) {
                $nilai_jual[] = 4;
            } elseif ($nsb->saldo <= 69000 and $nsb->saldo >= 40000 ) {
                $nilai_jual[] = 3;
            } elseif ($nsb->saldo <= 39000 and $nsb->saldo >= 10000 ) {
                $nilai_jual[] = 2;
            } elseif ($nsb->saldo <= 9000) {
                $nilai_jual[] = 1;
            }
        }
        foreach ($data_banyak_jenis_sampah as $dbjs) {
            if ($dbjs->banyak_jenis_sampah >= 5) {
                $nilai_jenis[] = 3;
            } elseif ($dbjs->banyak_jenis_sampah <= 4 and $dbjs->banyak_jenis_sampah >= 2 ) {
                $nilai_jenis[] = 2;
            } elseif ($dbjs->banyak_jenis_sampah <= 1) {
                $nilai_jenis[] = 1;
            }
        }

        foreach ($data_volume_sampah as $dvs) {
            if ($dvs->volume >= 100) {
                $nilai_volume[] = 5;
            } elseif ($dvs->volume <= 99 and $dvs->volume >= 70 ) {
                $nilai_volume[] = 4;
            } elseif ($dvs->volume <= 69 and $dvs->volume >= 40 ) {
                $nilai_volume[] = 3;
            } elseif ($dvs->volume <= 39 and $dvs->volume >= 10 ) {
                $nilai_volume[] = 2;
            } elseif ($dvs->volume <= 1) {
                $nilai_volume[] = 1;
            }
        }

        foreach ($nilai_jual as $nj) {
            $nilai_normalisasi_jual[] = $nj/4;
        }
        foreach ($nilai_jenis as $njs) {
            $nilai_normalisasi_jenis[] = $njs/3;
        }
        foreach ($nilai_volume as $nv) {
            $nilai_normalisasi_volume[] = $nv/5;
        }

        $c1 = 0.4;
        $c2 = 0.35;
        $c3 = 0.25;

        foreach ($nilai_normalisasi_jual as $nnj) {
            $nilai_preferensi_jual[] = $nnj*$c1;
        }
        foreach ($nilai_normalisasi_jenis as $nnjs) {
            $nilai_preferensi_jenis[] = $nnjs*$c2;
        }
        foreach ($nilai_normalisasi_volume as $nnv) {
            $nilai_preferensi_volume[] = $nnv*$c3;
        }

        for ($i=0; $i < count($nilai_preferensi_jual); $i++) {
            $nilai_akhir[] = $nilai_preferensi_jual[$i]+$nilai_preferensi_jenis[$i]+$nilai_preferensi_volume[$i];
        }
        foreach ($nilai_akhir as $na) {
            $nilai_akhir2[] = round($na,2);
        }
        $i = 0;
        foreach ($nasabah as $nas) {
            $data_nilai_nasabah[] = [
                "nama" => $nas->nama,
                "nilai" => $nilai_akhir2[$i++],
            ];
        }

        return view('Dashboard',compact('jml_nasabah','total_pendapatan','total_sampah','data_jml_sampah','data_kategori','data_nilai_nasabah'));
    }
}
