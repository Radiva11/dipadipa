@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Form Aspirasi -->
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kirim Aspirasi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.aspirasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" maxlength="50" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" rows="4" class="form-control" maxlength="255" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Aspirasi</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Histori Aspirasi -->
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"> Histori Aspirasi</h5>
                </div>
                <div class="card-body" style="max-height: 500px; overflow-y: auto;">
                    @forelse($histori as $aspirasi)
                    <div class="card mb-3 border-{{ $aspirasi->status == 'menunggu' ? 'warning' : ($aspirasi->status == 'proses' ? 'info' : 'success') }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="badge bg-primary mb-2">{{ $aspirasi->kategori->nama_kategori }}</span>
                                    <h6 class="mb-1">{{ $aspirasi->lokasi }}</h6>
                                    <p class="text-muted mb-2">{{ $aspirasi->keterangan }}</p>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>{{ $aspirasi->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <span class="badge bg-{{ $aspirasi->status == 'menunggu' ? 'warning' : ($aspirasi->status == 'proses' ? 'info' : 'success') }}">
                                    {{ ucfirst($aspirasi->status) }}
                                </span>
                            </div>

                            @if($aspirasi->feedbacks->count() > 0)
                            <div class="mt-3 p-3 bg-light rounded">
                                <strong class="text-primary"><i class="fas fa-comment me-1"></i>Feedback:</strong>
                                @foreach($aspirasi->feedbacks as $feedback)
                                <p class="mb-1">{{ $feedback->feedback }}</p>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>Admin • {{ $feedback->created_at->diffForHumans() }}
                                </small>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p>Belum ada aspirasi yang dikirim</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
