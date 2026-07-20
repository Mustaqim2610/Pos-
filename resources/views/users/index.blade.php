@extends('layouts.app')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')

<div class="card card-pos">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="fas fa-users-gear me-2 text-primary"></i>Data User</span>
        <button class="btn btn-primary btn-sm rounded-3 px-3"
                data-bs-toggle="modal" data-bs-target="#modalCreate">
            <i class="fas fa-plus me-1"></i>Tambah User
        </button>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-pos">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Bergabung</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $i => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $i }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:36px;height:36px;background:#eff6ff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;color:#2563eb;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="fw-semibold">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td style="color:#64748b;">{{ $user->email }}</td>
                        <td>
                            @if($user->role->value === 'admin')
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-3 px-2 py-1">
                                    <i class="fas fa-shield-halved me-1"></i>Administrator
                                </span>
                            @else
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-3 px-2 py-1">
                                    <i class="fas fa-user me-1"></i>Kasir
                                </span>
                            @endif
                        </td>
                        <td style="color:#64748b;">{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm rounded-3">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @else
                            <span style="font-size:11px;color:#94a3b8;">Anda</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-users fa-2x mb-2 d-block opacity-25"></i>
                            Belum ada user
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-3">
            <div style="font-size:13px; color:#64748b;">
                Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} user
            </div>
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

{{-- Modal Tambah User --}}
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold">
                    <i class="fas fa-user-plus me-2 text-primary"></i>Tambah User
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body pt-3">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px;">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Masukkan nama" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px;">Email</label>
                            <input type="email" name="email" class="form-control"
                                   placeholder="email@example.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px;">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="kasir">Kasir</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:13px;">Password</label>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Min. 6 karakter" required minlength="6">
                        </div>
                    </div>
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

@endsection
