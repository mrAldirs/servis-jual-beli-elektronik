@extends('layouts.app')

@section('title', 'Admin | Detail Barang')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Katalog Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('barangs.index') }}">Barang</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        @if ($dataBarang->foto)
                                            <img src="{{ url('img_barang') . '/' . $dataBarang->foto }}" class="mx-auto">
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <form>
                                            <fieldset>
                                                <div class="mb-2">
                                                    <label for="nama" class="form-label">Nama Barang</label>
                                                    <input type="text" id="nama" class="form-control" disabled
                                                        readonly value="{{ $dataBarang->nama }}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="jenis" class="form-label">Jenis Barang</label>
                                                    <input type="text" id="jenis" class="form-control" disabled
                                                        readonly value="{{ $dataBarang->jenis }}">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="keterangan" class="form-label">Keterangan</label>
                                                    <textarea id="keterangan" cols="30" rows="2" class="form-control" disabled readonly>{{ $dataBarang->keterangan }}</textarea>
                                                </div>
                                                @foreach ($dataBarang->katalogBarangs as $barang)
                                                    <div class="mb-2">
                                                        <label for="spesifikasi" class="form-label">Spesifikasi</label>
                                                        <textarea id="spesifikasi" cols="30" rows="2" class="form-control" disabled readonly>{{ $barang->spesifikasi }}</textarea>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="harga" class="form-label">Harga</label>
                                                        <input type="text" id="harga" class="form-control" disabled
                                                            readonly
                                                            value="Rp.{{ number_format($barang->harga, 2, ',', '.') }}">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="status" class="form-label">Status Ketersediaan</label>
                                                        <input type="text" id="status" class="form-control" disabled
                                                            readonly value="{{ $barang->status }}">
                                                    </div>
                                                @endforeach
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p><strong>Dibuat pada :</strong>{{ $dataBarang->created_at }}</p>
                                    <p><strong>Diedit pada :</strong>{{ $dataBarang->updated_at }}</p>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali ke
                                        Halaman Sebelumnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
