@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Aspirasi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Siswa</th>
                                    <th>Kelas</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($aspirasis as $index => $aspirasi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $aspirasi->siswa->name }}</td>
                                    <td>{{ $aspirasi->siswa->kelas }}</td>
                                    <td>{{ $aspirasi->kategori->nama_kategori }}</td>
                                    <td>{{ $aspirasi->lokasi }}</td>
                                    <td>{{ $aspirasi->keterangan }}</td>
                                    <td>
                                        <span class="badge bg-{{
                                            $aspirasi->status == 'menunggu' ? 'warning' :
                                            ($aspirasi->status == 'proses' ? 'info' : 'success')
                                        }}">
                                            {{ ucfirst($aspirasi->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $aspirasi->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary"
                                                onclick="beriFeedback({{ $aspirasi->id }})">
                                            <i class="fas fa-comment"></i> Feedback
                                        </button>
                                    </td>
                                </tr>

                                <!-- Tampilkan feedback jika ada -->
                                @if($aspirasi->feedbacks?->count() > 0)
                                <tr class="table-light">
                                    <td colspan="9" class="p-3">
                                        <strong class="text-primary">
                                            <i class="fas fa-comment-dots me-1"></i>Feedback:
                                        </strong>
                                        @foreach($aspirasi->feedbacks as $feedback)
                                        <div class="ms-3 mt-2">
                                            <p class="mb-1">{{ $feedback->feedback }}</p>
                                            <small class="text-muted">
                                                <i class="fas fa-user me-1"></i>{{ $feedback->admin->name }}
                                                • {{ $feedback->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif

                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-5">
                                        <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                        Belum ada aspirasi
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

<!-- Modal Feedback -->
<div class="modal fade" id="feedbackModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-comment me-2"></i>Beri Feedback
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.feedback.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="aspirasi_id" id="aspirasi_id">

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="menunggu">Menunggu</option>
                            <option value="proses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Feedback</label>
                        <textarea name="feedback" rows="4" class="form-control"
                                  placeholder="Masukkan feedback..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function beriFeedback(aspirasiId) {
    document.getElementById('aspirasi_id').value = aspirasiId;
    var modal = new bootstrap.Modal(document.getElementById('feedbackModal'));
    modal.show();
}
</script>
@endpush
@endsection
