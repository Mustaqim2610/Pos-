@extends('layouts.app')

@section('title', 'Kategori')
@section('page-title', 'Data Kategori')

@section('content')

<div class="card card-pos">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="fas fa-tags me-2 text-primary"></i>Data Kategori</span>
        <button class="btn btn-primary btn-sm rounded-3 px-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="fas fa-plus me-1"></i>Tambah Kategori
        </button>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-pos">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Produk</th>
                        <th style="width:120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $i => $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $i }}</td>
                        <td class="fw-semibold">{{ $category->name }}</td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-3">
                                {{ $category->products_count ?? 0 }} produk
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-warning btn-sm rounded-3"
                                        onclick="editKategori({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                        data-bs-toggle="modal" data-bs-target="#modalEdit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                      onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-3">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="fas fa-tags fa-2x mb-2 d-block opacity-25"></i>
                            Belum ada kategori
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3">
            <div style="font-size:13px; color:#64748b;">
                Menampilkan {{ $categories->firstItem() }}–{{ $categories->lastItem() }} dari {{ $categories->total() }} data
            </div>
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

{{-- Modal Create --}}
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold"><i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Kategori</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-body pt-3">
                    <label class="form-label fw-semibold" style="font-size:13px;">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Minuman" required>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold"><i class="fas fa-pen me-2 text-warning"></i>Edit Kategori</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-body pt-3">
                    <label class="form-label fw-semibold" style="font-size:13px;">Nama Kategori</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning rounded-3 px-4">
                        <i class="fas fa-save me-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function editKategori(id, name) {
    document.getElementById('editForm').action = '/categories/' + id;
    document.getElementById('editName').value = name;
}
</script>
@endpush
