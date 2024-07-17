<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Nasabah;
use App\Models\Sampah;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::all();
        $sampah = Sampah::all();

        return view('transaksi.create', compact('nasabah','sampah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nasabah' => 'required|string',
            'sampah' => 'required|string',
            'qty' => 'required|integer',
        ]);

        $data1 = [
            "id_nasabah" => $request->nasabah,
            "tanggal_transaksi" => $request->tanggal,
        ];
        $id_transaksi = DB::table('transaksi')->select('id')->orderBy("id","desc")->limit(1)->get();
        foreach ($id_transaksi as $id) {
            $idtrans = $id->id+1;
        }
        $data2 = [
            "id_transaksi" => $idtrans,
            "id_sampah" => $request->sampah,
            "quantity" => $request->qty
        ];
        $saldo_nasabah = DB::table("nasabah")->select("saldo")->where("id","$request->nasabah")->get();
        foreach ($saldo_nasabah as $sn) {
            $saldo = $sn->saldo;
        }
        $harga_sampah = DB::table("sampah")->select("harga_satuan")->where("id","$request->sampah")->get();
        foreach ($harga_sampah as $hs) {
            $harga = $hs->harga_satuan;
        }
        $data3 = [
            "saldo" => $saldo+$request->qty*$harga
        ];

        Transaksi::create($data1);
        DetailTransaksi::create($data2);
        Nasabah::where("id","$request->nasabah")->update($data3);

        return redirect()->route('nasabah.index')->with('success', 'sampah berhasil ditambahkan.');
    }

    // public function show(Sampah $sampah)
    // {
    //     return view('sampah.show', compact('sampah'));
    // }

    // public function edit(Sampah $sampah)
    // {
    //     $kategori = KategoriSampah::all();
    //     $nama_kategori = KategoriSampah::where("id",$sampah->id_kategori_sampah)
    //                 ->get();
    //     return view('sampah.edit', compact('sampah','kategori','nama_kategori'));
    // }

    // public function update(Request $request, Sampah $sampah)
    // {
    //     $request->validate([
    //         'id_kategori_sampah' => 'required|integer',
    //         'sampah' => 'required|string',
    //         'satuan' => 'required|string',
    //         'harga_satuan' => 'required|integer',
    //     ]);
    //     $data = [
    //         "sampah" => $request->nama_sampah,
    //         "id_kategori_sampah" => $request->kategori_sampah,
    //         "satuan" => $request->satuan,
    //         "harga_satuan" => $request->harga_satuan,
    //     ];

    //     $sampah->update($data);

    //     return redirect()->route('sampah.index')->with('success', 'Sampah Berhasil di Update.');
    // }

    // public function destroy(Sampah $sampah)
    // {
    //     $sampah->delete();

    //     return redirect()->route('sampah.index')->with('success', 'Sampah Berhasil di Hapus.');
    // }
}
