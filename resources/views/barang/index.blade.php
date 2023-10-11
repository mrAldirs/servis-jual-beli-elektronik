@extends('layouts.app')

@section('title', 'Admin | Dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Katalog Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Barang</li>
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
                            <div class="card-header">
                                <h3 class="card-title">Data Katalog Barang</h3>
                                <a href="{{ route('barangs.create') }}" class="btn btn-primary float-right"><i
                                        class="fa fa-plus-square fa-lg"></i></a>
                            </div>
                            <div class="card-body">
                                <table id="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Harga</th>
                                            <th width="180">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataBarang as $barang)
                                            <tr>
                                                <td class="text-center">
                                                    @if ($barang->foto)
                                                        <img src="{{ url('img_barang') . '/' . $barang->foto }}"
                                                            style="max-width: 60px;max-height:40px">
                                                    @endif
                                                </td>
                                                <td>{{ $barang->nama }}</td>
                                                <td>{{ $barang->jenis }}</td>
                                                @foreach ($barang->katalogBarangs as $katalog)
                                                    <td>Rp.{{ number_format($katalog->harga, 2, ',', '.') }}</td>
                                                @endforeach
                                                <td class="text-center">
                                                    <a href="{{ route('barangs.show', [$barang->id]) }}"
                                                        class='btn btn-info btn-sm'>Detail</a>
                                                    <Edit href="" class='btn btn-secondary btn-sm'>Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
