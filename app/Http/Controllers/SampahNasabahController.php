<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SampahNasabahController extends Controller
{
    public function index()
    {
        $nama = Auth::user()->name;
        $data_sampah = DB::select("SELECT transaksi.tanggal_transaksi, kategori_sampah.nama_kategori_sampah, sampah.sampah, detail_transaksi.quantity, (sampah.harga_satuan*detail_transaksi.quantity) as harga FROM transaksi
        RIGHT JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id
        JOIN nasabah ON nasabah.id = transaksi.id_nasabah
        JOIN sampah ON sampah.id = detail_transaksi.id_sampah
        JOIN kategori_sampah ON sampah.id_kategori_sampah = kategori_sampah.id
        WHERE nasabah.nama = '$nama'
        GROUP BY transaksi.tanggal_transaksi, kategori_sampah.nama_kategori_sampah, sampah.sampah, detail_transaksi.quantity, harga");
        foreach ($data_sampah as $ds) {
            $harga[] = $ds->harga;
        }
        $total_harga = array_sum($harga);

        return view('sampah-nasabah.index', compact('data_sampah','total_harga'));
    }

    public function create()
    {
        $sampah = Sampah::all();
        return view('sampah-nasabah.create', compact('sampah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'sampah' => 'required|string',
            'quantity' => 'required|integer',
        ]);
        $nama_nasabah = $nama = Auth::user()->name;
        $id_nasabah = DB::select("SELECT id from nasabah WHERE nama='$nama_nasabah'");
        foreach ($id_nasabah as $idn) {
            $idnas = $idn;
        }
        foreach ($idnas as $i) {
            $idnasabah = $i;
        }
        $data1 = [
            "id_nasabah" => $idnasabah,
            "tanggal_transaksi" => $request->tanggal,
        ];
        $id_transaksi = DB::table('transaksi')->select('id')->orderBy("id","desc")->limit(1)->get();
        foreach ($id_transaksi as $id) {
            $idtrans = $id+1;
        }
        foreach ($idtrans as $idt) {
            $idtransaksi = $idt+1;
        }
        $data2 = [
            "id_transaksi" => $idtransaksi,
            "id_sampah" => $request->sampah,
            "quantity" => $request->quantity
        ];
        $saldo_nasabah = DB::table("nasabah")->select("saldo")->where("nama","$nama_nasabah");
        foreach ($saldo_nasabah as $sn) {
            $saldo = $sn;
        }
        foreach ($saldo as $s) {
            $saldoawal = $s;
        }
        $harga_sampah = DB::table("sampah")->select("harga_satuan")->where("id","$request->sampah");
        foreach ($harga_sampah as $hs) {
            $harga = $hs;
        }
        foreach ($harga as $h) {
            $hargasampah = $h;
        }
        $data3 = [
            "saldo" => $saldoawal+$request->quantity*$hargasampah
        ];

        DB::beginTransaction();
        try {
            DB::table('transaksi')->insert($data1);
            DB::table('detail_transaksi')->insert($data2);
            DB::table('nasabah')->where("id","$idnasabah")->update($data3);
            return redirect()->route('sampah-nasabah.index')->with('success', 'sampah berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('sampah-nasabah.index')->with('error', 'sampah berhasil ditambahkan.');
        }
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
