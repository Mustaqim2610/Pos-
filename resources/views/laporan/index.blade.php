
@extends('layouts.app')

@section('content')

<div class="card shadow-lg border-0 rounded-4">

    <div class="card-header bg-danger text-white d-flex justify-content-between">

        <h4>

            <i class="fas fa-file-pdf"></i>

            Laporan Penjualan

        </h4>

        <div>

            <a href=""
               class="btn btn-light">

               Export PDF

            </a>

            <a href=""
               class="btn btn-warning">

               Export Excel

            </a>

        </div>

    </div>

    <div class="card-body">

        <table class="table table-striped">

            <thead>

            <tr>

                <th>No</th>
                <th>Invoice</th>
                <th>Tanggal</th>
                <th>Total</th>

            </tr>

            </thead>

            <tbody>

            @foreach($laporan as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->kode_invoice }}</td>

                <td>{{ $item->created_at }}</td>

                <td>
                    Rp {{ number_format($item->total_harga) }}
                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
