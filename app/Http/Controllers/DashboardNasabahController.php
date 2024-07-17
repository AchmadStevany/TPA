<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use App\Models\Nasabah;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriSampah;

class DashboardNasabahController extends Controller
{
    public function index()
    {
        $nasabah = DB::select("SELECT transaksi.id_nasabah, nasabah.nama, nasabah.saldo FROM transaksi
        RIGHT JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id
        JOIN nasabah ON nasabah.id = transaksi.id_nasabah
        JOIN sampah ON sampah.id = detail_transaksi.id_sampah
        GROUP BY transaksi.id_nasabah, nasabah.nama, nasabah.saldo");

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

        $kategori = KategoriSampah::all();

        $data_total_harga = DB::select("SELECT kategori_sampah.nama_kategori_sampah, sum(sampah.harga_satuan*detail_transaksi.quantity) as harga FROM detail_transaksi
        LEFT JOIN transaksi ON transaksi.id = detail_transaksi.id_transaksi
        JOIN sampah ON sampah.id = detail_transaksi.id_sampah
        JOIN kategori_sampah ON kategori_sampah.id = sampah.id_kategori_sampah
        GROUP BY kategori_sampah.nama_kategori_sampah");

        $data_dampak_ling = [7,10,11,6];

        $data_volume = DB::select("SELECT kategori_sampah.nama_kategori_sampah, sum(detail_transaksi.quantity) as volume FROM detail_transaksi
        LEFT JOIN transaksi ON transaksi.id = detail_transaksi.id_transaksi
        JOIN sampah ON sampah.id = detail_transaksi.id_sampah
        JOIN kategori_sampah ON kategori_sampah.id = sampah.id_kategori_sampah
        GROUP BY kategori_sampah.nama_kategori_sampah");

        foreach ($data_total_harga as $dth) {
            if ($dth->harga >= 1000000) {
                $nilai_jual2[] = 5;
            } elseif ($dth->harga <= 900000 and $dth->harga >= 750000 ) {
                $nilai_jual2[] = 4;
            } elseif ($dth->harga <= 749000 and $dth->harga >= 500000 ) {
                $nilai_jual2[] = 3;
            } elseif ($dth->harga <= 499000 and $dth->harga >= 50000 ) {
                $nilai_jual2[] = 2;
            } elseif ($dth->harga <= 49000) {
                $nilai_jual2[] = 1;
            }
        }

        foreach ($data_dampak_ling as $ddl) {
            if ($ddl >= 10) {
                $nilai_dampak[] = 1;
            } elseif ($ddl <= 9 and $ddl >= 8.9 ) {
                $nilai_dampak[] = 2;
            } elseif ($ddl <= 8 and $ddl >= 5.9 ) {
                $nilai_dampak[] = 3;
            } elseif ($ddl <= 5 and $ddl >= 2.9 ) {
                $nilai_dampak[] = 4;
            } elseif ($ddl <= 2) {
                $nilai_dampak[] = 5;
            }
        }

        foreach ($data_volume as $dv) {
            if ($dv->volume >= 1000) {
                $nilai_volume2[] = 5;
            } elseif ($dv->volume <= 999 and $dv->volume >= 590 ) {
                $nilai_volume2[] = 4;
            } elseif ($dv->volume <= 589 and $dv->volume >= 390 ) {
                $nilai_volume2[] = 3;
            } elseif ($dv->volume <= 389 and $dv->volume >= 100 ) {
                $nilai_volume2[] = 2;
            } elseif ($dv->volume <= 99) {
                $nilai_volume2[] = 1;
            }
        }

        foreach ($nilai_jual2 as $nj) {
            $nilai_normalisasi_jual2[] = $nj/4;
        }
        foreach ($nilai_dampak as $nd) {
            $nilai_normalisasi_dampak[] = $nd/3;
        }
        foreach ($nilai_volume2 as $nv) {
            $nilai_normalisasi_volume2[] = $nv/4;
        }
        foreach ($nilai_normalisasi_jual2 as $nnj) {
            $nilai_preferensi_jual2[] = $nnj*0.4;
        }
        foreach ($nilai_normalisasi_dampak as $nnd) {
            $nilai_preferensi_dampak[] = $nnd*0.3;
        }
        foreach ($nilai_normalisasi_volume2 as $nnv) {
            $nilai_preferensi_volume2[] = $nnv*0.3;
        }

        for ($i=0; $i < count($nilai_preferensi_jual2); $i++) {
            $nilai_akhir3[] = $nilai_preferensi_jual2[$i]+$nilai_preferensi_dampak[$i]+$nilai_preferensi_volume2[$i];
        }
        $nilai_akhir4 = [$nilai_akhir3[3],$nilai_akhir3[1],$nilai_akhir3[0],$nilai_akhir3[2]];

        $i=0;
        $no=1;
        foreach ($kategori as $kat) {
            $data_nilai_kategori[] = [
                "no" => $no++,
                "nama" => $kat->nama_kategori_sampah,
                "nilai" => $nilai_akhir4[$i++],
            ];
        }

        return view('dashboard-nasabah',compact('data_nilai_kategori','data_nilai_nasabah'));
    }
}
