<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class KategoriSampahController extends Controller
{
    public function index()
    {
        $kategori = KategoriSampah::all();
        return view('kategori_sampah.index', compact('kategori'));
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
