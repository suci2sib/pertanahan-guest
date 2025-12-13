@extends('layouts.guest.app')

@section('title', 'Profil Saya')

@section('content')
<br><br>
<section class="section">
    <div class="container">
        
        {{-- Header Judul & Breadcrumb --}}
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil Pengguna</li>
                    </ol>
                </nav>
                <h2 class="fw-bold text-dark">Profil Saya</h2>
                <p class="text-muted">Kelola informasi profil dan keamanan akun Anda.</p>
            </div>
        </div>

        <div class="row">
            {{-- ========================== --}}
            {{-- KOLOM KIRI: KARTU PROFIL --}}
            {{-- ========================== --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 15px;">
                    <div class="card-body text-center p-4">
                        
                        {{-- Avatar / Foto Profil --}}
                        <div class="mb-3 position-relative d-inline-block">
                            <div class="rounded-circle overflow-hidden border border-3 border-light shadow-sm" 
                                 style="width: 140px; height: 140px; margin: 0 auto;">
                                @if($user->foto_profil && Storage::disk('public')->exists($user->foto_profil))
                                    <img src="{{ asset('storage/' . $user->foto_profil) }}" 
                                         alt="Foto Profil" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    {{-- Placeholder jika tidak ada foto --}}
                                    <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                                        <i class="lni lni-user" style="font-size: 60px;"></i>
                                    </div>
                                @endif
                            </div>
                            {{-- Status Dot --}}
                            <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-2" 
                                  title="Online" style="width: 20px; height: 20px;"></span>
                        </div>

                        {{-- Nama & Email --}}
                        <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-3 small">{{ $user->email }}</p>

                        {{-- Badges (Role & Status) --}}
                        {{-- PERBAIKAN: Menggunakan warna solid agar teks terbaca --}}
                        <div class="d-flex justify-content-center gap-2 mb-4">
                            <span class="badge bg-primary rounded-pill px-3">
                                {{ $user->role }}
                            </span>
                            <span class="badge bg-success rounded-pill px-3">
                                Aktif
                            </span>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary rounded-pill">
                                <i class="lni lni-pencil-alt me-2"></i> Edit Profil
                            </a>
                            <button class="btn btn-outline-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="lni lni-lock-alt me-2"></i> Ganti Password
                            </button>
                        </div>
                    </div>
                    
                    {{-- Footer Card --}}
                    <div class="card-footer bg-light text-center border-0 py-3 rounded-bottom-4">
                        <small class="text-muted">Bergabung sejak {{ $user->created_at->format('d M Y') }}</small>
                    </div>
                </div>
            </div>

            {{-- ============================== --}}
            {{-- KOLOM KANAN: DETAIL INFORMASI --}}
            {{-- ============================== --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-dark"><i class="lni lni-user me-2 text-primary"></i> Detail Informasi</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle">
                                <tbody>
                                    <tr class="border-bottom">
                                        <th class="py-3 text-muted w-25">Nama Lengkap</th>
                                        <td class="py-3 fw-bold text-dark">{{ $user->name }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th class="py-3 text-muted">Email</th>
                                        <td class="py-3">{{ $user->email }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th class="py-3 text-muted">No. Telepon</th>
                                        <td class="py-3">
                                            @if($user->no_hp)
                                                {{ $user->no_hp }}
                                            @else
                                                <span class="text-muted fst-italic small">Belum diisi</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <th class="py-3 text-muted">Role Akses</th>
                                        <td class="py-3">{{ $user->role }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-3 text-muted">Alamat</th>
                                        <td class="py-3">
                                            @if($user->alamat)
                                                {{ $user->alamat }}
                                            @else
                                                <span class="text-muted fst-italic small">Belum diisi</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Statistik Kecil (Opsional) --}}
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0 h-100" style="border-radius: 15px;">
                            <div class="card-body d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3 text-success">
                                    <i class="lni lni-shield fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1 small">Status Akun</h6>
                                    <h5 class="mb-0 fw-bold">Terverifikasi</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- ============================ --}}
{{-- MODAL GANTI PASSWORD --}}
{{-- ============================ --}}
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        {{-- Action mengarah ke route 'profile.updatePassword' --}}
        <form method="POST" action="{{ route('profile.updatePassword') }}" class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            @csrf
            @method('PUT')

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="lni lni-lock-alt me-2"></i> Ganti Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Password Lama</label>
                    <input type="password" name="current_password" class="form-control" placeholder="Masukkan password saat ini" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Password Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold text-muted">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru" required>
                </div>
            </div>

            <div class="modal-footer bg-light border-0 rounded-bottom-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger px-4">Simpan Password</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Menampilkan Notifikasi Sukses dengan Alert sederhana (atau SweetAlert jika ada)
    @if(session('success'))
        // Opsi 1: Alert biasa
        // alert("{{ session('success') }}");
        
        // Opsi 2: SweetAlert (Jika library terinstall di layout)
        if(typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        }
    @endif

    // Menampilkan Error Validasi Password (Modal tetap terbuka jika ada error)
    @if($errors->has('current_password') || $errors->has('password'))
        var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
        myModal.show();
    @endif
</script>
@endsection