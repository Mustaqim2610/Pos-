
@extends('layouts.app')

@section('content')

<div class="card shadow-lg border-0 rounded-4">

    <div class="card-header bg-warning">

        <h4 class="mb-0 text-dark">

            <i class="fas fa-edit"></i>

            Edit Produk

        </h4>

    </div>

    <div class="card-body">

        <form action="{{ route('produk.update',$produk->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Nama Produk</label>

                <input type="text"
                       name="nama_produk"
                       value="{{ $produk->nama_produk }}"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Harga</label>

                <input type="number"
                       name="harga"
                       value="{{ $produk->harga }}"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Stok</label>

                <input type="number"
                       name="stok"
                       value="{{ $produk->stok }}"
                       class="form-control">

            </div>

            <button class="btn btn-warning">

                Update Produk

            </button>

        </form>

    </div>

</div>

@endsection
