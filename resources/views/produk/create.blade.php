@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')

<div class="row justify-content-center">
<div class="col-xl-8">

<div class="card card-pos">
    <div class="card-header">
        <i class="fas fa-plus-circle me-2 text-primary"></i>Form Tambah Produk
    </div>
    <div class="card-body">

        @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e)
                <li style="font-size:13px;">{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="Masukkan nama produk">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Kategori <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Harga <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price') }}" placeholder="0" min="0">
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size:13px;">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                           value="{{ old('stock') }}" placeholder="0" min="0">
                    @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold" style="font-size:13px;">Foto Produk</label>
                    <input type="file" name="photo" id="photoInput"
                           class="form-control @error('photo') is-invalid @enderror"
                           accept="image/*" onchange="previewImg(this)">
                    @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="mt-2" id="previewWrap" style="display:none;">
                        <img id="previewImg" src="" class="rounded-3" height="120"
                             style="object-fit:cover; border:2px dashed #e2e8f0;">
                    </div>
                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4 rounded-3">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-light px-4 rounded-3">
                    <i class="fas fa-arrow-left me-2"></i>Batal
                </a>
            </div>

        </form>
    </div>
</div>

</div>
</div>

@endsection

@push('scripts')
<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('previewWrap').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
