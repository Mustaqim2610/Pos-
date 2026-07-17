
<div class="sidebar">

<style>

.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    background:linear-gradient(
    180deg,
    #0f172a,
    #1e293b);
    color:white;
    padding-top:20px;
}

.logo{
    text-align:center;
    font-size:25px;
    font-weight:bold;
    margin-bottom:30px;
}

.menu{
    padding:12px 20px;
    display:block;
    color:white;
    text-decoration:none;
    transition:.3s;
}

.menu:hover{
    background:#2563eb;
    border-radius:10px;
    margin:0 10px;
}

</style>

<div class="logo">
    <i class="fas fa-store"></i>
    POS APP
</div>

<a href="/dashboard" class="menu">
    <i class="fas fa-chart-line"></i>
    Dashboard
</a>

<a href="/kategori" class="menu">
    <i class="fas fa-tags"></i>
    Kategori
</a>

<a href="/produk" class="menu">
    <i class="fas fa-box"></i>
    Produk
</a>

<a href="/penjualan" class="menu">
    <i class="fas fa-cart-shopping"></i>
    Penjualan
</a>

<a href="/transaksi" class="menu">
    <i class="fas fa-receipt"></i>
    Riwayat
</a>

<a href="/laporan" class="menu">
    <i class="fas fa-file-lines"></i>
    Laporan
</a>

<a href="/logout" class="menu">
    <i class="fas fa-right-from-bracket"></i>
    Logout
</a>