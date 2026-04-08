@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-users me-2"></i>Manajemen Users</h4>
                </div>
                <div class="card-body">

                    <!-- Tombol Tambah User -->
                    <div class="mb-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
                            <i class="fas fa-plus-circle me-2"></i>Tambah User Baru
                        </button>
                    </div>

                    <!-- Tabel Daftar Users -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'success' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->kelas ?? '-' }}</td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($user->role != 'admin' || Auth::user()->id != $user->id)
                                        <button class="btn btn-sm btn-danger"
                                                onclick="hapusUser({{ $user->id }}, '{{ $user->name }}')"
                                                {{ $user->role == 'admin' ? 'disabled' : '' }}
                                                title="{{ $user->role == 'admin' ? 'Tidak bisa hapus admin' : 'Hapus user' }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <i class="fas fa-users fa-3x mb-3"></i><br>
                                        Belum ada user
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i>Tambah User Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required minlength="5">
                        <small class="text-muted">Minimal 5 karakter</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-control" required id="roleSelect">
                            <option value="">Pilih Role</option>
                            <option value="siswa">Siswa</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3" id="kelasField">
                        <label class="form-label">Kelas</label>
                        <select name="kelas" class="form-control">
                            <option value="">Pilih Kelas</option>
                            <option value="X-1">X-1</option>
                            <option value="X-2">X-2</option>
                            <option value="X-3">X-3</option>
                            <option value="XI-1">XI-1</option>
                            <option value="XI-2">XI-2</option>
                            <option value="XI-3">XI-3</option>
                            <option value="XII-1">XII-1</option>
                            <option value="XII-2">XII-2</option>
                            <option value="XII-3">XII-3</option>
                        </select>
                        <small class="text-muted">Kelas hanya untuk siswa</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus User -->
<div class="modal fade" id="hapusUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus user <strong id="namaUser"></strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-info-circle me-1"></i>
                    Semua aspirasi dari user ini juga akan ikut terhapus!
                </p>
            </div>
            <div class="modal-footer">
                <form id="hapusUserForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Toggle field kelas berdasarkan role
document.getElementById('roleSelect').addEventListener('change', function() {
    var kelasField = document.getElementById('kelasField');
    if (this.value === 'siswa') {
        kelasField.style.display = 'block';
    } else {
        kelasField.style.display = 'none';
    }
});

// Fungsi Hapus User
function hapusUser(id, name) {
    document.getElementById('namaUser').innerText = name;
    document.getElementById('hapusUserForm').action = '/admin/users/' + id;
    var modal = new bootstrap.Modal(document.getElementById('hapusUserModal'));
    modal.show();
}

// Set initial state untuk kelas field
document.addEventListener('DOMContentLoaded', function() {
    var roleSelect = document.getElementById('roleSelect');
    var kelasField = document.getElementById('kelasField');
    if (roleSelect.value === 'admin') {
        kelasField.style.display = 'none';
    }
});
</script>
@endpush
@endsection
