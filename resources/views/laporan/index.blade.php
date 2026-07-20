@extends('layouts.app')

@section('title', 'Laporan Penjualan')
@section('page-title', 'Laporan Penjualan')

@section('content')

{{-- ── Stat Cards ── --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-pos">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:52px;height:52px;background:#eff6ff;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;color:#2563eb;">
                    <i class="fas fa-receipt"></i>
                </div>
                <div>
                    <div style="font-size:12px;color:#64748b;font-weight:500;">Total Transaksi</div>
                    <div style="font-size:22px;font-weight:700;color:#1e293b;">{{ number_format($totalTransactions) }}</div>
                    <div style="font-size:11px;color:#94a3b8;">Transaksi</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-pos">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:52px;height:52px;background:#f0fdf4;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;color:#10b981;">
                    <i class="fas fa-coins"></i>
                </div>
                <div>
                    <div style="font-size:12px;color:#64748b;font-weight:500;">Total Pendapatan</div>
                    <div style="font-size:18px;font-weight:700;color:#1e293b;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    <div style="font-size:11px;color:#94a3b8;">Periode ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-pos">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:52px;height:52px;background:#fefce8;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;color:#d97706;">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div>
                    <div style="font-size:12px;color:#64748b;font-weight:500;">Rata-rata Transaksi</div>
                    <div style="font-size:18px;font-weight:700;color:#1e293b;">Rp {{ $totalTransactions > 0 ? number_format($totalRevenue / $totalTransactions, 0, ',', '.') : 0 }}</div>
                    <div style="font-size:11px;color:#94a3b8;">Per transaksi</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Filter + Export ── --}}
<div class="card card-pos mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:12px;">Dari Tanggal</label>
                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:12px;">Sampai Tanggal</label>
                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-3 px-4">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                    <a href="{{ route('reports.index') }}" class="btn btn-light rounded-3 px-3">Reset</a>
                    <a href="{{ route('reports.index', array_merge(request()->all(), ['export'=>'pdf'])) }}"
                       class="btn btn-danger rounded-3 px-3">
                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                    </a>
                    <a href="{{ route('reports.index', array_merge(request()->all(), ['export'=>'excel'])) }}"
                       class="btn btn-success rounded-3 px-3">
                        <i class="fas fa-file-excel me-1"></i>Export Excel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ── Chart Harian ── --}}
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card card-pos">
            <div class="card-header">
                <i class="fas fa-chart-bar me-2 text-primary"></i>Grafik Penjualan Harian
            </div>
            <div class="card-body">
                <canvas id="dailyChart" height="70"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- ── Transaction Table ── --}}
<div class="card card-pos">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="fas fa-table me-2"></i>Data Transaksi</span>
        <span class="badge bg-primary rounded-3">{{ $sales->total() }} transaksi</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-pos mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $i => $sale)
                    <tr>
                        <td>{{ $sales->firstItem() + $i }}</td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-3">
                                {{ $sale->invoice }}
                            </span>
                        </td>
                        <td>{{ $sale->created_at->format('d M Y, H:i') }}</td>
                        <td>{{ $sale->user->name ?? 'Kasir' }}</td>
                        <td class="fw-semibold text-success">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
                @if($sales->count() > 0)
                <tfoot>
                    <tr class="table-light">
                        <td colspan="4" class="fw-bold text-end">Grand Total</td>
                        <td class="fw-bold text-success" style="font-size:15px;">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <div class="d-flex align-items-center justify-content-between p-3">
            <div style="font-size:13px; color:#64748b;">
                Menampilkan {{ $sales->firstItem() }}–{{ $sales->lastItem() }} dari {{ $sales->total() }} transaksi
            </div>
            {{ $sales->appends(request()->all())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const dailyLabels = @json($dailyLabels);
const dailyData   = @json($dailyData);

new Chart(document.getElementById('dailyChart'), {
    type: 'bar',
    data: {
        labels: dailyLabels,
        datasets: [{
            label: 'Pendapatan',
            data: dailyData,
            backgroundColor: '#2563eb',
            borderRadius: 6,
            borderSkipped: false,
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
            x: { grid: { display: false }, ticks: { font: { size: 11 } } },
            y: {
                grid: { color: '#f1f5f9' },
                ticks: {
                    font: { size: 11 },
                    callback: v => 'Rp ' + (v / 1000).toFixed(0) + 'K'
                }
            }
        }
    }
});
</script>
@endpush
