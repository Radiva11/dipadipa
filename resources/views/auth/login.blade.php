@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm mt-5">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0">
                    <i class="fas fa-school me-2"></i>LAPSEKAR
                </h4>
                <small>SMPN 5 Tangerang</small>
            </div>
            <div class="card-body p-4">

                {{-- Tampilkan error jika ada --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- FORM LOGIN --}}
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-user text-primary"></i>
                            </span>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="Masukkan Nama Lengkap"
                                   required>
                        </div>
                    </div>

                    {{-- Ganti bagian Kelas yang lama dengan ini --}}
                    <div class="mb-3">
                        <label for="kelas" class="form-label fw-bold">Kelas</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-graduation-cap text-primary"></i>
                        </span>
                    {{-- Input text menggantikan select agar bisa mengetik bebas --}}
                    <input type="text"
                         name="kelas"
                        id="kelas"
                        class="form-control @error('kelas') is-invalid @enderror"
                        placeholder="Contoh: VII atau X" required>
                    </div>
                        <small class="text-muted">Masukkan kelas sesuai data sekolah (VII, VIII, atau X).</small>
                    </div>


                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-lock text-primary"></i>
                            </span>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Masukkan password"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3 form-check d-flex justify-content-between align-items-center">
                        <div>
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>
                </form>

                <div class="text-center mt-3 text-muted">
                    <small>Sistem Pengaduan Sarana Sekolah SMPN 5 Tangerang v1.0</small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
@endpush
@endsection
                {{-- Demo credentials --}}
                {{-- <div class="mt-4 p-3 bg-light rounded">
                    <small class="text-muted fw-bold">DEMO AKUN:</small>
                    <div class="row mt-2 small">
                        <div class="col-6">
                            <span class="badge bg-info">Siswa</span><br>
                            <span class="text-muted">Username: siswa</span><br>
                            <span class="text-muted">Password: siswa123</span> {{-- Ganti dari 123456 --}}
                        {{-- </div>
                        <div class="col-6">
                            <span class="badge bg-warning">Admin</span><br>
                            <span class="text-muted">Username: admin</span><br>
                            <span class="text-muted">Password: admin123</span>
                        </div>
                    </div>
                </div> --}}
