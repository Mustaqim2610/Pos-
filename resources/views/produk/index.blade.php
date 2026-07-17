
@extends('layouts.app')

@section('content')

<div class="card card-modern">

<div class="card-header bg-white d-flex justify-content-between">

<h4>Data Produk</h4>

<a href="/produk/create"
class="btn btn-primary">

Tambah Produk

</a>

</div>

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>No</th>
<th>Gambar</th>
<th>Produk</th>
<th>Harga</th>
<th>Stok</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($produk as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>

<img
src="{{ asset('storage/'.$item->gambar) }}"
width="70"
class="rounded">

</td>

<td>{{ $item->nama_produk }}</td>

<td>
Rp {{ number_format($item->harga) }}
</td>

<td>

<span class="badge bg-success">

{{ $item->stok }}

</span>

</td>

<td>

<a href=""
class="btn btn-warning btn-sm">

Edit

</a>

<a href=""
class="btn btn-danger btn-sm">

Hapus

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endsection
