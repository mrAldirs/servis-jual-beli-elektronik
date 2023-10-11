<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::orderBy('created_at', 'DESC')->get();
        return view('barang.index')->with('dataBarang', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('harga', $request->harga);
        Session::flash('spesifikasi', $request->spesifikasi);
        Session::flash('keterangan', $request->keterangan);
        Session::flash('foto', $request->keterangan);

        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'spesifikasi' => 'required',
            'keterangan' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg,gif'
        ], [
            'nama.required' => 'Nama Barang harus diisi',
            'harga.required' => 'Harga Barang harus diisi',
            'harga.numeric' => 'Harga Barang harus berupa angka',
            'spesifikasi.required' => 'Spesifikasi Barang harus diisi',
            'keterangan.required' => 'Keterangan Barang harus diisi',
            'foto.required' => 'Silahkan masukkan foto',
            'foto.mimes' => 'Foto harus berekstensi JPG, JPEG, PNG, dan GIF'
        ]);

        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = "IMG_" . date('ymdhis') . "." . $foto_ekstensi;
        $foto_file->move(public_path('img_barang'), $foto_nama);

        $dataBarang = [
            // 'id' => Uuid::uuid4(),
            'nama' => $request->input('nama'),
            'jenis' => $request->input('jenis'),
            'status' => 'jual',
            'foto' => $foto_nama,
            'keterangan' => $request->input('keterangan')
        ];

        $barang = Barang::create($dataBarang);

        $dataKatalog = [
            'barang_id' => $barang->id,
            'spesifikasi' => $request->input('spesifikasi'),
            'harga' => $request->input('harga'),
            'status' => 'tersedia'
        ];

        Katalog::create($dataKatalog);

        Session::flash('success', 'Data berhasil ditambahkan.');

        return redirect('barangs');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Barang::find($id);
        return view('barang.show')->with('dataBarang', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
