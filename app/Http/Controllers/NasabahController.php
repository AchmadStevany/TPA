<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::all();
        return view('nasabah.index', compact('nasabah'));
    }

    // public function create()
    // {
    //     $kategori = KategoriSampah::all();
    //     return view('sampah.create', compact('kategori'));
    // }

    // public function store(Request $request)
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

    //     Sampah::create($data);

    //     return redirect()->route('sampah.index')->with('success', 'sampah berhasil ditambahkan.');
    // }

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
