@extends('layouts.app')

@section('title', 'Admin | Insert Barang')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('barangs.index') }}">Barang</a></li>
                            <li class="breadcrumb-item active">Insert</li>
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
                                    <div class="col-12">
                                        <form action="{{ route('barangs.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Barang</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ Session::get('nama') }}">
                                                @error('nama')
                                                    <div class="alert alert-danger mt-2" role="alert">
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
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga Barang</label>
                                                <input type="text" class="form-control" id="harga" name="harga"
                                                    value="{{ Session::get('harga') }}">
                                                @error('harga')
                                                    <div class="alert alert-danger mt-2" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="spesifikasi" class="form-label">Spesifikasi Barang</label>
                                                <textarea id="spesifikasi" name="spesifikasi" cols="30" rows="3" class="form-control">{{ Session::get('spesifikasi') }}</textarea>
                                                @error('spesifikasi')
                                                    <div class="alert alert-danger mt-2" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan" class="form-label">Keterangan Barang</label>
                                                <textarea id="keterangan" name="keterangan" cols="30" rows="3" class="form-control">{{ Session::get('keterangan') }}</textarea>
                                                @error('keterangan')
                                                    <div class="alert alert-danger mt-2" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto" class="form-label">Foto Barang</label>
                                                <input type="file" class="form-control" id="foto" name="foto">
                                                @error('foto')
                                                    <div class="alert alert-danger mt-2" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
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
