@extends('layouts.guest.app')

@section('title', 'Edit Profil')

@section('content')
<br><br>
<section class="section">
    <div class="container">
        
        {{-- Header Breadcrumb --}}
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                    </ol>
                </nav>
                <h3 class="fw-bold">Pengaturan Akun</h3>
            </div>
        </div>

        <div class="row">
            {{-- KOLOM KIRI: EDIT DATA DIRI & FOTO --}}
            <div class="col-lg-7 mb-4">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="mb-0 fw-bold text-primary"><i class="lni lni-user me-2"></i> Edit Informasi Data Diri</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Alert Error jika ada --}}
                            @if ($errors->any())
                                <div class="alert alert-danger rounded-3 mb-4">
                                    <ul class="mb-0 small">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Section Ganti Foto --}}
                            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3">
                                <div class="me-3 position-relative">
                                    <div class="rounded-circle overflow-hidden border border-2 border-white shadow-sm" style="width: 80px; height: 80px;">
                                        @if($user->foto_profil && Storage::disk('public')->exists($user->foto_profil))
                                            <img src="{{ asset('storage/' . $user->foto_profil) }}" id="preview-img" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary bg-opacity-25 w-100 h-100 d-flex align-items-center justify-content-center text-secondary" id="placeholder-icon">
                                                <i class="lni lni-user fs-1"></i>
                                            </div>
                                            {{-- Img hidden untuk preview nanti --}}
                                            <img id="preview-img" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label fw-bold mb-1">Foto Profil</label>
                                    <input type="file" name="foto_profil" class="form-control form-control-sm" accept="image/*" onchange="previewFile(this)">
                                    <small class="text-muted" style="font-size: 11px;">Format: JPG, PNG. Maks 2MB.</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-uppercase text-muted">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-uppercase text-muted">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-muted">No. Handphone</label>
                                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}" placeholder="Contoh: 0812...">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-muted">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <a href="{{ route('profile.show') }}" class="text-decoration-none text-muted">
                                    <i class="lni lni-arrow-left"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                    <i class="lni lni-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: GANTI PASSWORD --}}
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                    <div class="card-header bg-danger text-white py-3 border-bottom-0" style="border-radius: 15px 15px 0 0;">
                        <h5 class="mb-0 fw-bold"><i class="lni lni-lock-alt me-2"></i> Keamanan</h5>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-3">Ganti password secara berkala untuk menjaga keamanan akun Anda.</p>
                        
                        <form action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Password Lama</label>
                                <input type="password" name="current_password" class="form-control" placeholder="••••••••" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Min. 8 karakter" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-outline-danger">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Info Tambahan (Opsional) --}}
                <div class="card shadow-sm border-0" style="border-radius: 15px; background-color: #eef2f7;">
                    <div class="card-body p-4 d-flex align-items-center">
                        <i class="lni lni-shield-check text-success fs-1 me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Akun Terverifikasi</h6>
                            <p class="small text-muted mb-0">Role Anda saat ini adalah <strong>{{ $user->role }}</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- SCRIPT PREVIEW IMAGE --}}
<script>
    function previewFile(input){
        var file = input.files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                var img = document.getElementById("preview-img");
                var icon = document.getElementById("placeholder-icon");
                
                if(icon) icon.style.display = 'none'; // Sembunyikan icon placeholder
                
                img.src = reader.result;
                img.style.display = "block"; // Tampilkan gambar
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection