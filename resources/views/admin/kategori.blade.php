@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-tags me-2"></i>Manajemen Kategori</h4>
                </div>
                <div class="card-body">

                    <!-- Form Tambah Kategori -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Kategori Baru</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.kategori.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   name="nama_kategori"
                                                   class="form-control @error('nama_kategori') is-invalid @enderror"
                                                   placeholder="Masukkan nama kategori"
                                                   value="{{ old('nama_kategori') }}"
                                                   required>
                                            @error('nama_kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Simpan Kategori
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Kategori -->
                    <h5 class="mb-3">
                        <i class="fas fa-list me-2"></i>Daftar Kategori
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="60%">Nama Kategori</th>
                                    <th width="20%">Jumlah Aspirasi</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategoris as $index => $kategori)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $kategori->aspirasis_count ?? 0 }} Aspirasi
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning"
                                                onclick="editKategori({{ $kategori->id }}, '{{ $kategori->nama_kategori }}')"
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                                onclick="hapusKategori({{ $kategori->id }})"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        <i class="fas fa-tags fa-3x mb-3"></i><br>
                                        Belum ada kategori
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

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white">
                    <i class="fas fa-edit me-2"></i>Edit Kategori
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="edit_nama_kategori" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Kategori -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kategori <strong id="delete_kategori_name"></strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-info-circle me-1"></i>
                    Aspirasi dengan kategori ini akan kehilangan referensi kategori.
                </p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
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
// Fungsi Edit
function editKategori(id, nama) {
    document.getElementById('edit_nama_kategori').value = nama;
    document.getElementById('editForm').action = `/admin/kategori/${id}`;
    var modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
}

// Fungsi Hapus
function hapusKategori(id) {
    // Ambil nama kategori dari baris yang diklik
    var row = event.target.closest('tr');
    var nama = row.cells[1].innerText;

    document.getElementById('delete_kategori_name').innerText = nama;
    document.getElementById('deleteForm').action = `/admin/kategori/${id}`;
    var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endpush
@endsection
