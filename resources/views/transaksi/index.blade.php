@extends('layouts.app')

@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')

<div class="card card-pos">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="fas fa-receipt me-2 text-warning"></i>Riwayat Transaksi</span>
        <a href="{{ route('reports.index') }}" class="btn btn-success btn-sm rounded-3 px-3">
            <i class="fas fa-file-export me-1"></i>Export Excel
        </a>
    </div>
    <div class="card-body">

        {{-- Filter --}}
        <form method="GET" class="row g-2 mb-4 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:12px;">Cari Invoice</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="q" class="form-control border-start-0 bg-light"
                           placeholder="INV-..." value="{{ request('q') }}">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:12px;">Dari Tanggal</label>
                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold" style="font-size:12px;">Sampai Tanggal</label>
                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-3 px-3">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <a href="{{ route('sales.index') }}" class="btn btn-light rounded-3 px-3">Reset</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-pos">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $i => $sale)
                    <tr>
                        <td>{{ $sales->firstItem() + $i }}</td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-3 px-2 py-1">
                                {{ $sale->invoice }}
                            </span>
                        </td>
                        <td>{{ $sale->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:28px;height:28px;background:#e2e8f0;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#64748b;">
                                    {{ strtoupper(substr($sale->user->name ?? 'K', 0, 1)) }}
                                </div>
                                {{ $sale->user->name ?? 'Kasir' }}
                            </div>
                        </td>
                        <td class="fw-semibold text-success">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm rounded-3"
                                    onclick="lihatDetail({{ $sale->id }})"
                                    data-bs-toggle="modal" data-bs-target="#modalDetail">
                                <i class="fas fa-eye me-1"></i>Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-receipt fa-2x mb-2 d-block opacity-25"></i>
                            Belum ada transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3">
            <div style="font-size:13px; color:#64748b;">
                Menampilkan {{ $sales->firstItem() }}–{{ $sales->lastItem() }} dari {{ $sales->total() }} transaksi
            </div>
            {{ $sales->appends(request()->all())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

{{-- Modal Detail --}}
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0">
                <h6 class="modal-title fw-bold">
                    <i class="fas fa-receipt me-2 text-primary"></i>Detail Transaksi
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailContent">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function lihatDetail(id) {
    document.getElementById('detailContent').innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary"></div></div>';

    fetch('/sales/' + id + '/detail', { headers: {'X-Requested-With':'XMLHttpRequest'} })
        .then(r => r.json())
        .then(data => {
            let rows = data.details.map(d =>
                `<tr>
                    <td>${d.product_name}</td>
                    <td class="text-center">${d.qty}</td>
                    <td class="text-end">Rp ${Number(d.price).toLocaleString('id-ID')}</td>
                    <td class="text-end fw-semibold">Rp ${Number(d.subtotal).toLocaleString('id-ID')}</td>
                </tr>`
            ).join('');

            document.getElementById('detailContent').innerHTML = `
            <div class="row mb-3" style="font-size:13px;">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted">Invoice</td><td><strong>${data.invoice}</strong></td></tr>
                        <tr><td class="text-muted">Tanggal</td><td>${data.date}</td></tr>
                        <tr><td class="text-muted">Kasir</td><td>${data.cashier}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><td class="text-muted">Total</td><td><strong class="text-success">Rp ${Number(data.total).toLocaleString('id-ID')}</strong></td></tr>
                        <tr><td class="text-muted">Bayar</td><td>Rp ${Number(data.paid).toLocaleString('id-ID')}</td></tr>
                        <tr><td class="text-muted">Kembalian</td><td>Rp ${Number(data.change).toLocaleString('id-ID')}</td></tr>
                    </table>
                </div>
            </div>
            <table class="table table-pos">
                <thead><tr><th>Produk</th><th class="text-center">Qty</th><th class="text-end">Harga</th><th class="text-end">Subtotal</th></tr></thead>
                <tbody>${rows}</tbody>
            </table>`;
        });
}
</script>
@endpush
