
@extends('layouts.app')

@section('content')

<div class="card shadow-lg border-0 rounded-4">

    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            <i class="fas fa-plus-circle"></i>
            Tambah Produk
        </h4>
    </div>

    <div class="card-body">

        <form action="{{ route('produk.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label class="form-label">
                    Nama Produk
                </label>

                <input type="text"
                       name="nama_produk"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Kategori
                </label>

                <select name="kategori_id"
                        class="form-select">

                    @foreach($kategori as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->nama_kategori }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <label class="form-label">
                        Harga
                    </label>

                    <input type="number"
                           name="harga"
                           class="form-control">

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Stok
                    </label>

                    <input type="number"
                           name="stok"
                           class="form-control">

                </div>

            </div>

            <div class="mt-3">

                <label class="form-label">
                    Gambar Produk
                </label>

                <input type="file"
                       name="gambar"
                       class="form-control">

            </div>

            <button class="btn btn-primary mt-4">
                Simpan Produk
            </button>

        </form>

    </div>

</div>

@endsection