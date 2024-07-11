<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::all();
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
        return view('nasabah.index', compact('nasabah','data_nilai_nasabah'));
    }

    public function create()
    {
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_nasabah' => 'required|string',
            'alamat' => 'required|string',
        ]);
        $data = [
            "nama" => $request->nama_nasabah,
            "alamat" => $request->alamat,
        ];

        Nasabah::create($data);

        return redirect()->route('nasabah.index')->with('success', 'nasabah berhasil ditambahkan.');
    }

    public function show(Nasabah $nasabah)
    {
        return view('nasabah.show', compact('nasabah'));
    }

    public function edit(Nasabah $nasabah)
    {
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        $request->validate([
            'nama_nasabah' => 'required|string',
            'alamat' => 'required|string',
        ]);
        $data = [
            "nama" => $request->nama_nasabah,
            "alamat" => $request->alamat,
        ];

        $nasabah->update($data);

        return redirect()->route('nasabah.index')->with('success', 'Nasabah Berhasil di Update.');
    }

    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();

        return redirect()->route('nasabah.index')->with('success', 'Nasabah Berhasil di Hapus.');
    }
}
