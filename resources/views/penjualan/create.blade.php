@extends('layouts.app')

@section('title', 'Kasir / Penjualan')
@section('page-title', 'Kasir / Penjualan')

@push('styles')
<style>
    .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 12px; }

    .product-card {
        background: #fff;
        border: 2px solid #f1f5f9;
        border-radius: 14px;
        padding: 12px;
        cursor: pointer;
        transition: all .2s;
        text-align: center;
    }
    .product-card:hover { border-color: #2563eb; box-shadow: 0 4px 16px rgba(37,99,235,.12); transform: translateY(-2px); }
    .product-card:active { transform: scale(.97); }
    .product-card .p-img {
        width: 64px; height: 64px;
        border-radius: 10px;
        object-fit: cover;
        margin: 0 auto 8px;
        background: #f1f5f9;
        display: flex; align-items: center; justify-content: center;
    }
    .product-card .p-name { font-size: 12.5px; font-weight: 600; color: #1e293b; line-height: 1.3; }
    .product-card .p-price { font-size: 12px; color: #2563eb; font-weight: 700; margin-top: 4px; }
    .product-card .p-stock { font-size: 10.5px; color: #94a3b8; }
    .product-card.out-of-stock { opacity: .4; pointer-events: none; }

    .cart-item {
        display: flex; align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
    }
    .cart-item-name { flex: 1; font-weight: 600; color: #1e293b; }
    .qty-btn {
        width: 28px; height: 28px;
        border: none; border-radius: 8px;
        background: #f1f5f9;
        font-size: 16px; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: background .15s;
    }
    .qty-btn:hover { background: #e2e8f0; }
    .qty-val { min-width: 24px; text-align: center; font-weight: 600; }
    .cart-subtotal { font-size: 12px; color: #64748b; }
    .del-btn {
        width: 26px; height: 26px;
        background: #fee2e2; border: none; border-radius: 7px;
        color: #ef4444; font-size: 12px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: background .15s; flex-shrink: 0;
    }
    .del-btn:hover { background: #fecaca; }

    .total-box {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        border-radius: 14px; padding: 18px;
        color: #fff; margin-top: 16px;
    }
    .total-box .label { font-size: 12px; opacity: .65; }
    .total-box .amount { font-size: 22px; font-weight: 700; color: #4ade80; }

    .btn-bayar {
        height: 52px; border-radius: 14px;
        font-size: 15px; font-weight: 700;
        letter-spacing: .3px;
    }
    .btn-reset {
        height: 52px; border-radius: 14px;
        font-size: 14px; font-weight: 600;
    }

    .search-products {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        padding: 10px 16px 10px 42px;
        font-size: 14px;
        width: 100%;
    }
    .search-products:focus { border-color: #2563eb; outline: none; background: #fff; }
    .search-wrap { position: relative; margin-bottom: 16px; }
    .search-wrap .fa-search {
        position: absolute; left: 14px; top: 50%;
        transform: translateY(-50%); color: #94a3b8;
    }

    .kembalian-box {
        background: #f0fdf4; border: 1.5px solid #bbf7d0;
        border-radius: 12px; padding: 12px 16px;
        font-size: 13px;
    }
</style>
@endpush

@section('content')

<div class="row g-3">

    {{-- ── Left: Product List ── --}}
    <div class="col-xl-7">
        <div class="card card-pos h-100">
            <div class="card-header">
                <i class="fas fa-cash-register me-2 text-primary"></i>Kasir / Penjualan
            </div>
            <div class="card-body">
                <div class="search-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-products" id="searchProd"
                           placeholder="Cari produk (F2)" oninput="filterProducts()">
                </div>
                <div class="product-grid" id="productGrid">
                    @foreach($products as $product)
                    <div class="product-card {{ $product->stock <= 0 ? 'out-of-stock' : '' }}"
                         onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->stock }})"
                         data-name="{{ strtolower($product->name) }}">
                        @if($product->photo)
                            <img src="{{ asset('storage/'.$product->photo) }}" class="p-img" style="width:64px;height:64px;">
                        @else
                            <div class="p-img mx-auto"><i class="fas fa-image text-muted" style="font-size:20px;"></i></div>
                        @endif
                        <div class="p-name">{{ $product->name }}</div>
                        <div class="p-price">Rp {{ number_format($product->price,0,',','.') }}</div>
                        <div class="p-stock">Stok: {{ $product->stock }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ── Right: Cart ── --}}
    <div class="col-xl-5">
        <div class="card card-pos">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="fas fa-shopping-cart me-2 text-warning"></i>Keranjang Belanja</span>
                <span id="cartCount" class="badge bg-primary rounded-pill">0</span>
            </div>
            <div class="card-body">

                {{-- Cart header --}}
                <div class="d-flex" style="font-size:11px; font-weight:600; color:#94a3b8; text-transform:uppercase; padding:0 0 6px; border-bottom:1px solid #f1f5f9;">
                    <div style="flex:1;">Produk</div>
                    <div style="width:80px; text-align:center;">Harga</div>
                    <div style="width:90px; text-align:center;">Qty</div>
                    <div style="width:80px; text-align:right;">Subtotal</div>
                    <div style="width:30px;"></div>
                </div>

                {{-- Cart items --}}
                <div id="cartItems" style="min-height:180px; max-height:280px; overflow-y:auto;">
                    <div id="emptyCart" class="text-center text-muted py-5" style="font-size:13px;">
                        <i class="fas fa-cart-shopping fa-2x mb-2 d-block opacity-20"></i>
                        Keranjang masih kosong
                    </div>
                </div>

                {{-- Total box --}}
                <div class="total-box">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="label">Total Item</span>
                        <span id="totalItem" style="font-size:13px;">0 item</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="label">Total Bayar</span>
                        <span class="amount" id="totalAmount">Rp 0</span>
                    </div>
                </div>

                {{-- Payment input --}}
                <div class="mt-3">
                    <label class="form-label fw-semibold" style="font-size:12px;">Uang Bayar</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" id="paymentInput" class="form-control"
                               placeholder="0" min="0" oninput="calcChange()">
                    </div>
                </div>

                {{-- Kembalian --}}
                <div class="kembalian-box mt-2">
                    <div class="d-flex justify-content-between">
                        <span style="color:#166534; font-weight:600;">Kembalian</span>
                        <span id="changeDisplay" style="color:#16a34a; font-weight:700;">Rp 0</span>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="row g-2 mt-3">
                    <div class="col-5">
                        <button class="btn btn-danger btn-reset w-100" onclick="resetCart()">
                            <i class="fas fa-trash me-2"></i>Reset (F5)
                        </button>
                    </div>
                    <div class="col-7">
                        <button class="btn btn-success btn-bayar w-100" onclick="submitSale()">
                            <i class="fas fa-money-bill-wave me-2"></i>Bayar (F8)
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Hidden form --}}
<form id="saleForm" method="POST" action="{{ route('sales.store') }}" style="display:none;">
    @csrf
    <input type="hidden" name="cart" id="cartJson">
    <input type="hidden" name="paid" id="paidInput">
</form>

{{-- Modal Struk --}}
<div class="modal fade" id="modalStruk" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold"><i class="fas fa-receipt me-2 text-success"></i>Struk / Nota</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="window.location.reload()"></button>
            </div>
            <div class="modal-body" id="strukContent"></div>
            <div class="modal-footer border-0 pt-0 gap-2">
                <button class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal" onclick="window.location.reload()">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
                <button class="btn btn-primary rounded-3" onclick="printStruk()">
                    <i class="fas fa-print me-1"></i>Cetak Struk
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let cart = {};

function rupiah(n) {
    return 'Rp ' + Number(n).toLocaleString('id-ID');
}

function addToCart(id, name, price, stock) {
    if (cart[id]) {
        if (cart[id].qty >= stock) { alert('Stok tidak cukup!'); return; }
        cart[id].qty++;
    } else {
        cart[id] = { id, name, price, qty: 1, stock };
    }
    renderCart();
}

function changeQty(id, delta) {
    if (!cart[id]) return;
    cart[id].qty += delta;
    if (cart[id].qty <= 0) delete cart[id];
    renderCart();
}

function removeItem(id) {
    delete cart[id];
    renderCart();
}

function renderCart() {
    const items = Object.values(cart);
    const cartDiv = document.getElementById('cartItems');
    const empty = document.getElementById('emptyCart');

    if (items.length === 0) {
        cartDiv.innerHTML = '';
        cartDiv.appendChild(empty);
        document.getElementById('totalItem').textContent = '0 item';
        document.getElementById('totalAmount').textContent = 'Rp 0';
        document.getElementById('cartCount').textContent = '0';
        calcChange();
        return;
    }

    let total = 0, totalQty = 0;
    let html = '';

    items.forEach(item => {
        const sub = item.price * item.qty;
        total += sub; totalQty += item.qty;
        html += `
        <div class="cart-item">
            <div class="cart-item-name">${item.name}
                <div class="cart-subtotal">${rupiah(item.price)}</div>
            </div>
            <div style="width:80px; text-align:center; font-size:12px; color:#64748b;">${rupiah(item.price)}</div>
            <div style="width:90px; display:flex; align-items:center; justify-content:center; gap:4px;">
                <button class="qty-btn" onclick="changeQty(${item.id}, -1)">−</button>
                <span class="qty-val">${item.qty}</span>
                <button class="qty-btn" onclick="changeQty(${item.id}, 1)">+</button>
            </div>
            <div style="width:80px; text-align:right; font-size:12.5px; font-weight:600;">${rupiah(sub)}</div>
            <button class="del-btn" onclick="removeItem(${item.id})"><i class="fas fa-xmark"></i></button>
        </div>`;
    });

    cartDiv.innerHTML = html;
    document.getElementById('totalItem').textContent = totalQty + ' item';
    document.getElementById('totalAmount').textContent = rupiah(total);
    document.getElementById('cartCount').textContent = totalQty;
    calcChange();
}

function getTotal() {
    return Object.values(cart).reduce((s, i) => s + i.price * i.qty, 0);
}

function calcChange() {
    const paid = parseInt(document.getElementById('paymentInput').value) || 0;
    const total = getTotal();
    const change = paid - total;
    document.getElementById('changeDisplay').textContent = rupiah(change >= 0 ? change : 0);
    document.getElementById('changeDisplay').style.color = change < 0 ? '#ef4444' : '#16a34a';
}

function resetCart() {
    if (Object.keys(cart).length === 0) return;
    if (confirm('Reset keranjang belanja?')) { cart = {}; renderCart(); document.getElementById('paymentInput').value = ''; }
}

function submitSale() {
    const items = Object.values(cart);
    if (items.length === 0) { alert('Keranjang masih kosong!'); return; }

    const paid = parseInt(document.getElementById('paymentInput').value) || 0;
    const total = getTotal();

    if (paid < total) { alert('Uang bayar kurang!'); document.getElementById('paymentInput').focus(); return; }

    document.getElementById('cartJson').value = JSON.stringify(items);
    document.getElementById('paidInput').value = paid;

    // AJAX submit
    const form = document.getElementById('saleForm');
    const fd = new FormData(form);

    fetch(form.action, { method: 'POST', headers: {'X-Requested-With':'XMLHttpRequest'}, body: fd })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showStruk(data.sale, items, total, paid);
                cart = {};
                renderCart();
                document.getElementById('paymentInput').value = '';
            } else {
                alert(data.message || 'Gagal menyimpan transaksi.');
            }
        })
        .catch(() => alert('Terjadi kesalahan.'));
}

function showStruk(sale, items, total, paid) {
    const change = paid - total;
    let rows = items.map(i =>
        `<tr><td>${i.name}</td><td class="text-end">${i.qty}</td><td class="text-end">${Number(i.price).toLocaleString('id-ID')}</td><td class="text-end">${Number(i.price*i.qty).toLocaleString('id-ID')}</td></tr>`
    ).join('');

    document.getElementById('strukContent').innerHTML = `
    <div style="font-family:monospace; font-size:13px; padding:8px;">
        <div class="text-center mb-3">
            <strong style="font-size:15px;">TOKO MAJU JAYA</strong><br>
            <small>Jl. Contoh No. 123, Kota Anda</small><br>
            <small>Telp: 0812-3456-7890</small>
        </div>
        <hr style="border-top:2px dashed #ccc;">
        <table class="table table-sm table-borderless" style="font-size:12px;">
            <tr><td>INVOICE</td><td>: ${sale.invoice}</td></tr>
            <tr><td>TANGGAL</td><td>: ${sale.date}</td></tr>
            <tr><td>KASIR</td><td>: ${sale.cashier}</td></tr>
        </table>
        <hr style="border-top:2px dashed #ccc;">
        <table class="table table-sm table-borderless" style="font-size:12px;">
            <thead><tr><th>Produk</th><th class="text-end">Qty</th><th class="text-end">Harga</th><th class="text-end">Subtotal</th></tr></thead>
            <tbody>${rows}</tbody>
        </table>
        <hr style="border-top:2px dashed #ccc;">
        <table class="table table-sm table-borderless mb-1" style="font-size:12px;">
            <tr><td>TOTAL ITEM</td><td class="text-end">${items.length}</td></tr>
            <tr class="fw-bold"><td>TOTAL BAYAR</td><td class="text-end">Rp ${total.toLocaleString('id-ID')}</td></tr>
            <tr><td>BAYAR</td><td class="text-end">Rp ${paid.toLocaleString('id-ID')}</td></tr>
            <tr class="fw-bold text-success"><td>KEMBALIAN</td><td class="text-end">Rp ${change.toLocaleString('id-ID')}</td></tr>
        </table>
        <hr style="border-top:2px dashed #ccc;">
        <div class="text-center" style="font-size:12px; color:#64748b;">Terima kasih atas kunjungan Anda!</div>
    </div>`;

    new bootstrap.Modal(document.getElementById('modalStruk')).show();
}

function printStruk() {
    const content = document.getElementById('strukContent').innerHTML;
    const w = window.open('', '', 'width=400,height=600');
    w.document.write('<html><head><title>Struk</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></head><body style="padding:20px;">' + content + '</body></html>');
    w.document.close();
    w.print();
}

function filterProducts() {
    const q = document.getElementById('searchProd').value.toLowerCase();
    document.querySelectorAll('.product-card').forEach(c => {
        c.style.display = c.dataset.name.includes(q) ? '' : 'none';
    });
}

// Keyboard shortcuts
document.addEventListener('keydown', e => {
    if (e.key === 'F2') { e.preventDefault(); document.getElementById('searchProd').focus(); }
    if (e.key === 'F5') { e.preventDefault(); resetCart(); }
    if (e.key === 'F8') { e.preventDefault(); submitSale(); }
});
</script>
@endpush
