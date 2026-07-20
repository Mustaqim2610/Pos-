@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ── Stat Cards ── --}}
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#3b82f6,#2563eb);">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="label">Total Produk</div>
                    <div class="value">{{ number_format($totalProducts) }}</div>
                    <div class="sub">Produk</div>
                </div>
                <div class="icon-wrap"><i class="fas fa-box-open"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#10b981,#059669);">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="label">Total Kategori</div>
                    <div class="value">{{ number_format($totalCategories) }}</div>
                    <div class="sub">Kategori</div>
                </div>
                <div class="icon-wrap"><i class="fas fa-tags"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#f59e0b,#d97706);">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="label">Total Transaksi</div>
                    <div class="value">{{ number_format($totalTransactions) }}</div>
                    <div class="sub">Transaksi</div>
                </div>
                <div class="icon-wrap"><i class="fas fa-receipt"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" style="background: linear-gradient(135deg,#8b5cf6,#7c3aed);">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="label">Total Pendapatan</div>
                    <div class="value" style="font-size:18px;">Rp {{ number_format($totalRevenue,0,',','.') }}</div>
                    <div class="sub">Bulan ini</div>
                </div>
                <div class="icon-wrap"><i class="fas fa-dollar-sign"></i></div>
            </div>
        </div>
    </div>
</div>

{{-- ── Chart + Recent Transactions ── --}}
<div class="row g-3 mb-4">

    {{-- Sales Chart --}}
    <div class="col-xl-8">
        <div class="card card-pos h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-chart-line me-2 text-primary"></i>Grafik Penjualan (6 Bulan Terakhir)</span>
                <select class="form-select form-select-sm w-auto border-0 bg-light rounded-3">
                    <option>6 Bulan Terakhir</option>
                    <option>3 Bulan Terakhir</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="col-xl-4">
        <div class="card card-pos h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-clock me-2 text-warning"></i>Transaksi Terbaru</span>
                <a href="{{ route('sales.index') }}" class="text-primary" style="font-size:12px; text-decoration:none;">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @forelse($recentSales as $sale)
                <div class="d-flex align-items-center justify-content-between px-3 py-2"
                     style="border-bottom:1px solid #f1f5f9;">
                    <div>
                        <div style="font-size:13px; font-weight:600; color:#1e293b;">{{ $sale->invoice }}</div>
                        <div style="font-size:11px; color:#94a3b8;">{{ $sale->created_at->format('d M Y · H:i') }}</div>
                    </div>
                    <div style="font-size:13px; font-weight:700; color:#10b981;">
                        Rp {{ number_format($sale->total,0,',','.') }}
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4" style="font-size:13px;">Belum ada transaksi</div>
                @endforelse
            </div>
        </div>
    </div>

</div>

{{-- ── Top Products ── --}}
<div class="row g-3">
    <div class="col-12">
        <div class="card card-pos">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-fire me-2 text-danger"></i>Produk Terlaris</span>
                <a href="{{ route('products.index') }}" class="text-primary" style="font-size:12px; text-decoration:none;">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-pos mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Terjual</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts as $product)
                        <tr>
                            <td class="fw-500">{{ $product->name }}</td>
                            <td>{{ number_format($product->total_sold ?? 0) }}</td>
                            <td class="fw-600 text-success">Rp {{ number_format(($product->total_sold ?? 0) * $product->price, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">Belum ada data produk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const labels = @json($chartLabels);
const data   = @json($chartData);

const ctx = document.getElementById('salesChart').getContext('2d');

const gradient = ctx.createLinearGradient(0, 0, 0, 300);
gradient.addColorStop(0, 'rgba(37,99,235,0.25)');
gradient.addColorStop(1, 'rgba(37,99,235,0.0)');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Pendapatan',
            data: data,
            borderColor: '#2563eb',
            backgroundColor: gradient,
            borderWidth: 2.5,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#2563eb',
            pointRadius: 4,
            pointHoverRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                }
            }
        },
        scales: {
            x: { grid: { display: false }, ticks: { font: { size: 12 } } },
            y: {
                grid: { color: '#f1f5f9' },
                ticks: {
                    font: { size: 11 },
                    callback: v => 'Rp ' + (v/1000000).toFixed(0) + 'JT'
                }
            }
        }
    }
});
</script>
@endpush
