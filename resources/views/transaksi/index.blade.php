
@extends('layouts.app')

@section('content')

<div class="card shadow-lg border-0 rounded-4">

    <div class="card-header bg-info text-white">

        <h4>

            <i class="fas fa-receipt"></i>

            Riwayat Transaksi

        </h4>

    </div>

    <div class="card-body">

        <table class="table table-hover">

            <thead>

            <tr>

                <th>Invoice</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Tanggal</th>

            </tr>

            </thead>

            <tbody>

            @foreach($transaksi as $item)

            <tr>

                <td>{{ $item->kode_invoice }}</td>

                <td>{{ $item->user->name }}</td>

                <td>
                    Rp {{ number_format($item->total_harga) }}
                </td>

                <td>
                    {{ $item->created_at }}
                </td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
