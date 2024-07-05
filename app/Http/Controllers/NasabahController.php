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
