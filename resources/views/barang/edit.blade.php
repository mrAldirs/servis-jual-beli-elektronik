@extends('layouts.app')

@section('title', 'Admin | Edit Barang')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('barangs.index') }}">Barang</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-11 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-11 m-auto">
                                        <form id="editForm" action="{{ route('barangs.update', $data->id) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Barang</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ $data->nama }}">
                                                @error('nama')
                                                    <div id="error-container" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis" class="form-label">Jenis Barang</label>
                                                <select class="form-control" aria-label="jenis" name="jenis"
                                                    id="jenis">
                                                    <option value="Televisi">Televisi</option>
                                                    <option value="Air Conditioner (AC)">Air Conditioner (AC)
                                                    </option>
                                                    <option value="Laptop">Laptop</option>
                                                    <option value="Handphone">Handphone</option>
                                                </select>
                                            </div>

                                            @foreach ($data->katalogBarangs as $barang)
                                                <div class="mb-3">
                                                    <label for="harga" class="form-label">Harga Barang</label>
                                                    <input type="text" class="form-control" id="harga" name="harga"
                                                        value="{{ $barang->harga }}">
                                                    @error('harga')
                                                        <div id="error-container" style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="spesifikasi" class="form-label">Spesifikasi Barang</label>
                                                    <textarea id="spesifikasi" name="spesifikasi" cols="30" rows="3" class="form-control">{{ $barang->spesifikasi }}</textarea>
                                                    @error('spesifikasi')
                                                        <div id="error-container" style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="keterangan" class="form-label">Keterangan Barang</label>
                                                    <textarea id="keterangan" name="keterangan" cols="30" rows="3" class="form-control">{{ $data->keterangan }}</textarea>
                                                    @error('keterangan')
                                                        <div id="error-container" style="color: red;">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            @endforeach

                                            @if ($data->foto)
                                                <div class="mb-3">
                                                    <img src="{{ url('img_barang') . '/' . $data->foto }}" alt=""
                                                        style="max-width: 120px;max-height:120px">
                                                </div>
                                            @endif

                                            <div class="mb-5">
                                                <label for="foto" class="form-label">Foto Barang</label>
                                                <input type="file" class="form-control" id="foto" name="foto">
                                                @error('foto')
                                                    <div id="error-container" style="color: red;">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="m-3">
                                                <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali ke
                                                    Halaman Sebelumnya</a>
                                                <button id="saveButton" type="button"
                                                    class="btn btn-primary float-right px-5">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
