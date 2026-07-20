@extends('layouts.app')

@section('title', 'Data Produk')
@section('page-title', 'Data Produk')

@push('styles')
<style>
    .search-box {
        width: 280px;
        height: 42px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 0 16px 0 42px;
        font-size: 13.5px;
        background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.099zm-5.242 1.656a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z'/%3E%3C/svg%3E") no-repeat 13px center;
        transition: border-color .2s;
    }
    .search-box:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,.08);
    }

    .btn-tambah {
        height: 42px;
        padding: 0 20px;
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 7px;
        transition: background .2s, transform .15s;
        text-decoration: none;
    }
    .btn-tambah:hover {
        background: #1d4ed8;
        color: #fff;
        transform: translateY(-1px);
    }

    /* Table */
    .produk-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .produk-table thead tr {
        background: #f8fafc;
    }
    .produk-table thead th {
        padding: 12px 16px;
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        border-bottom: 2px solid #f1f5f9;
        white-space: nowrap;
    }
    .produk-table tbody tr {
        border-bottom: 1px solid #f8fafc;
        transition: background .15s;
    }
    .produk-table tbody tr:hover {
        background: #f8fafc;
    }
    .produk-table tbody td {
        padding: 14px 16px;
        font-size: 14px;
        color: #334155;
        vertical-align: middle;
    }

    /* Product image */
    .prod-img {
        width: 56px;
        height: 56px;
        border-radius: 10px;
        object-fit: cover;
        border: 1.5px solid #f1f5f9;
    }
    .prod-img-placeholder {
        width: 56px;
        height: 56px;
        border-radius: 10px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
        font-size: 20px;
        border: 1.5px solid #e2e8f0;
    }

    /* Category badge */
    .cat-badge {
        background: #eff6ff;
        color: #2563eb;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Stock badge */
    .stock-ok   { color: #16a34a; font-weight: 600; }
    .stock-low  { color: #d97706; font-weight: 600; }
    .stock-out  { color: #dc2626; font-weight: 600; }

    /* Action buttons */
    .btn-edit {
        width: 34px; height: 34px;
        border: none; border-radius: 8px;
        background: #f59e0b;
        color: #fff;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 13px;
        cursor: pointer;
        transition: background .15s, transform .1s;
    }
    .btn-edit:hover { background: #d97706; transform: scale(1.08); }

    .btn-del {
        width: 34px; height: 34px;
        border: none; border-radius: 8px;
        background: #ef4444;
        color: #fff;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 13px;
        cursor: pointer;
        transition: background .15s, transform .1s;
    }
    .btn-del:hover { background: #dc2626; transform: scale(1.08); }

    /* Pagination */
    .pagination .page-link {
        border-radius: 8px !important;
        margin: 0 2px;
        border: 1.5px solid #e2e8f0;
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
        padding: 6px 12px;
        transition: all .15s;
    }
    .pagination .page-link:hover {
        background: #eff6ff;
        border-color: #2563eb;
        color: #2563eb;
    }
    .pagination .page-item.active .page-link {
        background: #2563eb;
        border-color: #2563eb;
        color: #fff;
    }
    .pagination .page-item.disabled .page-link {
        opacity: .4;
    }

    /* Info pagination */
    .paging-info {
        font-size: 13px;
        color: #64748b;
    }
</style>
@endpush

@section('content')

<div class="card card-pos">
    <div class="card-body" style="padding: 24px;">

        {{-- ── Header Row ── --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <input type="text" class="search-box" id="searchInput"
                   placeholder="Cari produk..." oninput="filterTable()">
            <a href="{{ route('products.create') }}" class="btn-tambah">
                <i class="fas fa-plus" style="font-size:12px;"></i> + Tambah Produk
            </a>
        </div>

        {{-- ── Table ── --}}
        <div class="table-responsive">
            <table class="produk-table" id="produkTable">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th style="width:80px;">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $i => $product)
                    <tr>
                        {{-- No --}}
                        <td style="color:#94a3b8; font-weight:600;">
                            {{ $products->firstItem() + $i }}
                        </td>

                        {{-- Gambar --}}
                        <td>
                            @if($product->photo)
                                <img src="{{ asset('storage/' . $product->photo) }}"
                                     alt="{{ $product->name }}"
                                     class="prod-img">
                            @else
                                <div class="prod-img-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>

                        {{-- Nama --}}
                        <td>
                            <span style="font-weight:500; color:#1e293b;">
                                {{ $product->name }}
                            </span>
                        </td>

                        {{-- Kategori --}}
                        <td>
                            <span class="cat-badge">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>

                        {{-- Harga --}}
                        <td style="font-weight:600; color:#1e293b;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        {{-- Stok --}}
                        <td>
                            @if($product->stock <= 0)
                                <span class="stock-out">{{ $product->stock }}</span>
                            @elseif($product->stock <= 10)
                                <span class="stock-low">{{ $product->stock }}</span>
                            @else
                                <span class="stock-ok">{{ $product->stock }}</span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.edit', $product) }}"
                                   class="btn-edit" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus produk \'{{ addslashes($product->name) }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-del" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div style="color:#94a3b8;">
                                <i class="fas fa-box-open fa-3x mb-3 d-block opacity-20"></i>
                                <div style="font-size:14px; font-weight:500;">Belum ada produk</div>
                                <div style="font-size:12px; margin-top:4px;">
                                    Klik <strong>+ Tambah Produk</strong> untuk menambahkan
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ── Pagination ── --}}
        @if($products->hasPages() || $products->total() > 0)
        <div class="d-flex align-items-center justify-content-between mt-4">
            <div class="paging-info">
                @if($products->total() > 0)
                    Menampilkan
                    <strong>{{ $products->firstItem() }}</strong>
                    –
                    <strong>{{ $products->lastItem() }}</strong>
                    dari
                    <strong>{{ number_format($products->total()) }}</strong>
                    data
                @endif
            </div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
        @endif

    </div>
</div>

@endsection

@push('scripts')
<script>
function filterTable() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#produkTable tbody tr');
    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}

// Auto-focus search on load
document.getElementById('searchInput').focus();
</script>
@endpush
