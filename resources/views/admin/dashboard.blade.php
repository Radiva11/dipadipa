@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</h4>
                </div>
                <div class="card-body">
                    <!-- Statistik Cards -->
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Total Aspirasi</h6>
                                            <h2 class="mt-2 mb-0">{{ $totalAspirasi }}</h2>
                                        </div>
                                        <i class="fas fa-envelope fa-3x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Total Siswa</h6>
                                            <h2 class="mt-2 mb-0">{{ $totalSiswa }}</h2>
                                        </div>
                                        <i class="fas fa-users fa-3x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Total Kategori</h6>
                                            <h2 class="mt-2 mb-0">{{ $totalKategori }}</h2>
                                        </div>
                                        <i class="fas fa-tags fa-3x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Menunggu</h6>
                                            <h2 class="mt-2 mb-0">{{ $statistikStatus['menunggu'] }}</h2>
                                        </div>
                                        <i class="fas fa-clock fa-3x opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Status Detail -->
                    <div class="row mt-4">
                        <div class="col-md-4 mb-3">
                            <div class="card border-warning">
                                <div class="card-body">
                                    <h6 class="text-warning">Menunggu</h6>
                                    <h3>{{ $statistikStatus['menunggu'] }}</h3>
                                    <small class="text-muted">Aspirasi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-info">
                                <div class="card-body">
                                    <h6 class="text-info">Diproses</h6>
                                    <h3>{{ $statistikStatus['proses'] }}</h3>
                                    <small class="text-muted">Aspirasi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-success">
                                <div class="card-body">
                                    <h6 class="text-success">Selesai</h6>
                                    <h3>{{ $statistikStatus['selesai'] }}</h3>
                                    <small class="text-muted">Aspirasi</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Aspirasi Terbaru -->
                    <div class="mt-4">
                        <h5 class="mb-3">
                            <i class="fas fa-list me-2"></i>Aspirasi Terbaru
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Siswa</th>
                                        <th>Kelas</th>
                                        <th>Kategori</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($aspirasiTerbaru as $index => $aspirasi)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $aspirasi->siswa->name }}</td>
                                        <td>{{ $aspirasi->siswa->kelas }}</td>
                                        <td>{{ $aspirasi->kategori->nama_kategori }}</td>
                                        <td>{{ $aspirasi->lokasi }}</td>
                                        <td>
                                            <span class="badge bg-{{
                                                $aspirasi->status == 'menunggu' ? 'warning' :
                                                ($aspirasi->status == 'proses' ? 'info' : 'success')
                                            }}">
                                                {{ ucfirst($aspirasi->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $aspirasi->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i><br>
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
</div>
@endsection
