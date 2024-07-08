<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriSampahController extends Controller
{
    public function index()
    {
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
                $nilai_jual[] = 5;
            } elseif ($dth->harga <= 900000 and $dth->harga >= 750000 ) {
                $nilai_jual[] = 4;
            } elseif ($dth->harga <= 749000 and $dth->harga >= 500000 ) {
                $nilai_jual[] = 3;
            } elseif ($dth->harga <= 499000 and $dth->harga >= 50000 ) {
                $nilai_jual[] = 2;
            } elseif ($dth->harga <= 49000) {
                $nilai_jual[] = 1;
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
                $nilai_volume[] = 5;
            } elseif ($dv->volume <= 999 and $dv->volume >= 590 ) {
                $nilai_volume[] = 4;
            } elseif ($dv->volume <= 589 and $dv->volume >= 390 ) {
                $nilai_volume[] = 3;
            } elseif ($dv->volume <= 389 and $dv->volume >= 100 ) {
                $nilai_volume[] = 2;
            } elseif ($dv->volume <= 99) {
                $nilai_volume[] = 1;
            }
        }

        foreach ($nilai_jual as $nj) {
            $nilai_normalisasi_jual[] = $nj/4;
        }
        foreach ($nilai_dampak as $nd) {
            $nilai_normalisasi_dampak[] = $nd/3;
        }
        foreach ($nilai_volume as $nv) {
            $nilai_normalisasi_volume[] = $nv/4;
        }

        foreach ($nilai_normalisasi_jual as $nnj) {
            $nilai_preferensi_jual[] = $nnj*0.4;
        }
        foreach ($nilai_normalisasi_volume as $nnv) {
            $nilai_preferensi_dampak[] = $nnv*0.3;
        }
        foreach ($nilai_normalisasi_volume as $nnv) {
            $nilai_preferensi_volume[] = $nnv*0.3;
        }

        for ($i=0; $i < count($nilai_preferensi_jual); $i++) {
            $nilai_akhir[] = $nilai_preferensi_jual[$i]+$nilai_preferensi_dampak[$i]+$nilai_preferensi_volume[$i];
        }
        $nilai_akhir2 = [$nilai_akhir[3],$nilai_akhir[1],$nilai_akhir[0],$nilai_akhir[2]];

        $i=0;
        $no=1;
        foreach ($kategori as $kat) {
            $data_nilai_kategori[] = [
                "no" => $no++,
                "nama" => $kat->nama_kategori_sampah,
                "nilai" => $nilai_akhir2[$i++],
            ];
        }

        return view('kategori_sampah.index', compact('kategori','data_nilai_kategori'));
    }

    public function create()
    {
        return view('kategori_sampah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_sampah' => 'required|string',
        ]);
        $data    = [
            "nama_kategori_sampah" => $request->nama_kategori_sampah,
        ];

        KategoriSampah::create($data);

        return redirect()->route('kategori_sampah.index')->with('success', 'Kategori Sampah Berhasil Dibuat');
    }

    public function show(KategoriSampah $kategori)
    {
        return view('kategori_sampah.show', compact('kategori'));
    }

    public function edit(KategoriSampah $kategori)
    {
        return view('kategori_sampah.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriSampah $kategori)
    {
        $request->validate([
            'nama_kategori_product' => 'required|string',
        ]);
        $data    = [
            "nama_kategori_product" => $request->nama_kategori_product
        ];

        $kategori->update($data);

        return redirect()->route('kategori_sampah.index')->with('success', 'Kategori Sampah berhasil di Update');
    }

    public function destroy(KategoriSampah $kategori)
    {
        $data = [
            "deleted" => true
        ];
        $kategori->update($data);

        return redirect()->route('kategori_sampah.index')->with('success', 'Kategori Sampah Berhasil di Hapus');
    }
}
