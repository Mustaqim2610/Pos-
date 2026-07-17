
@extends('layouts.app')

@section('content')

<h2 class="page-title mb-4">
Dashboard Penjualan
</h2>

<div class="row">

<div class="col-md-3">

<div class="card card-modern">

<div class="card-body">

<h5>Total Produk</h5>

<h2 class="text-primary">
{{ $totalProduk }}
</h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-modern">

<div class="card-body">

<h5>Kategori</h5>

<h2 class="text-success">
{{ $totalKategori }}
</h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-modern">

<div class="card-body">

<h5>Transaksi</h5>

<h2 class="text-warning">
{{ $totalTransaksi }}
</h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card card-modern">

<div class="card-body">

<h5>Pendapatan</h5>

<h2 class="text-danger">
Rp {{ number_format($totalPendapatan) }}
</h2>

</div>

</div>

</div>

</div>

<div class="card card-modern mt-4">

<div class="card-header bg-white">

Grafik Penjualan

</div>

<div class="card-body">

<canvas id="salesChart"></canvas>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(
document.getElementById('salesChart'),
{
type:'bar',
data:{
labels:['Jan','Feb','Mar','Apr','Mei','Jun'],
datasets:[{
label:'Penjualan',
data:[120,180,220,170,250,310]
}]
}
});

</script>

@endsection
