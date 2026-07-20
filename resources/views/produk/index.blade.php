
@extends('layouts.app')

@section('content')

<div class="card card-modern">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Data Produk</h4>

        @can('create', App\Models\Product::class)
            <a href="{{ route('products.create') }}"
               class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Produk
            </a>
        @endcan

    </div>

    <div class="card-body">

        <table class="table table-hover table-bordered align-middle">

            <thead class="table-light">

                <tr>
                    <th width="50">No</th>
                    <th width="100">Gambar</th>
                    <th>Produk</th>
                    <th width="150">Harga</th>
                    <th width="120">Stok</th>
                    <th width="200">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($produk as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>

                            @if($item->gambar)

                                <img
                                    src="{{ asset('storage/' . $item->gambar) }}"
                                    width="70"
                                    class="rounded shadow-sm">

                            @else

                                <img
                                    src="{{ asset('images/no-image.png') }}"
                                    width="70"
                                    class="rounded">

                            @endif

                        </td>

                        <td>
                            {{ $item->nama_produk }}
                        </td>

                        <td>
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </td>

                        <td>

                            @if($item->stok > 10)

                                <span class="badge bg-success">
                                    {{ $item->stok }}
                                </span>

                            @elseif($item->stok > 0)

                                <span class="badge bg-warning">
                                    {{ $item->stok }}
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Habis
                                </span>

                            @endif

                        </td>

                        <td>

                            @can('update', $item)

                                <a href="{{ route('products.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                            @endcan

                            @can('delete', $item)

                                <form
                                    action="{{ route('products.destroy', $item->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">

                                        Hapus

                                    </button>

                                </form>

                            @endcan

                        </td

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Data produk belum tersedia

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $produk->links() }}

        </div>

    </div>

</div>

@endsection

