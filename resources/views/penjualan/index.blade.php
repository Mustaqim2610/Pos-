
@extends('layouts.app')

@section('content')

<div class="card shadow-lg border-0 rounded-4">

    <div class="card-header bg-success text-white">

        <h4>

            <i class="fas fa-cart-shopping"></i>

            Kasir Penjualan

        </h4>

    </div>

    <div class="card-body">

        <div class="row">

            @foreach($produk as $item)

            <div class="col-md-3 mb-4">

                <div class="card border-0 shadow">

                    <img src="{{ asset('storage/'.$item->gambar) }}"
                         height="180"
                         style="object-fit:cover">

                    <div class="card-body text-center">

                        <h5>{{ $item->nama_produk }}</h5>

                        <p class="text-primary fw-bold">

                            Rp {{ number_format($item->harga) }}

                        </p>

                        <button class="btn btn-success">

                            Tambah Keranjang

                        </button>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

@endsection
