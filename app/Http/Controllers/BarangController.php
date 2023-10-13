<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        if ($barang) {
            Session::flash('success', 'Data berhasil ditambahkan.');
        } else {
            Session::forget('success');
        }

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
        $data = Barang::find($id);
        return view('barang.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            'keterangan' => 'required'
        ], [
            'nama.required' => 'Nama Barang harus diisi',
            'harga.required' => 'Harga Barang harus diisi',
            'harga.numeric' => 'Harga Barang harus berupa angka',
            'spesifikasi.required' => 'Spesifikasi Barang harus diisi',
            'keterangan.required' => 'Keterangan Barang harus diisi'
        ]);

        $dataBarang = [
            'nama' => $request->input('nama'),
            'jenis' => $request->input('jenis'),
            'keterangan' => $request->input('keterangan')
        ];

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'required|mimes:png,jpg,jpeg,gif'
            ], [
                'foto.mimes' => 'Foto harus berekstensi JPG, JPEG, PNG, dan GIF'
            ]);

            // proses memasukkan foto baru
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = "IMG_" . date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('img_barang'), $foto_nama); // -> sudah terupload

            // proses menghapus foto diganti dengan foto yang baru
            $data_foto = Barang::where('id', $id)->first();
            File::delete(public_path('img_barang') . '/' . $data_foto->foto);

            // proses mengubah nama foto yang ada di database
            $dataBarang['foto'] = $foto_nama;
        }

        $barang = Barang::where('id', $id)->update($dataBarang);

        $dataKatalog = [
            'spesifikasi' => $request->input('spesifikasi'),
            'harga' => $request->input('harga')
        ];

        Katalog::where('barang_id', $id)->update($dataKatalog);
        if ($barang) {
            Session::flash('success', 'Data berhasil diubah.');
        } else {
            Session::forget('success');
        }

        return redirect('barangs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $data = Barang::where('id', $id)->first();

        $data = Barang::find($id);
        File::delete(public_path('img_barang' . '/' . $data->foto));
        $data->delete();

        if ($data) {
            Session::flash('success', 'Data berhasil dihapus.');
        } else {
            Session::forget('success');
        }

        return redirect(route('barangs.index'));
    }
}
