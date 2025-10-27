@extends('layouts.admin.user.app')

@section('content')
<section class="main-content">
    <div class="container-fluid py-5" style="background: linear-gradient(135deg, #f8d7e0, #fbe9d7);">
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-6 fw-bold text-danger">Data User</h1>
                    <p class="text-muted mb-0">Daftar pengguna sistem.</p>
                </div>
                <!-- Tombol Tambah -->
                <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalCreateUser">
                    <i class="bi bi-plus-circle me-2"></i> Tambah User
                </button>
            </div>

            
            @include('layouts.admin.user.error')
            <!-- Tabel Data User -->
            <div class="table-responsive bg-white rounded-4 shadow-sm p-4">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>
                                <a href="{{ route('users.edit', $data->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('users.destroy', $data->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger"
            onclick="return confirm('Yakin ingin menghapus user ini?')">
            Hapus
        </button>
    </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

<!-- Modal Tambah User -->
<div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="modalCreateUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header text-white" style="background: linear-gradient(90deg, #ff9db6, #ffd6e0);">
                <h5 class="modal-title fw-bold" id="modalCreateUserLabel">Tambah User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama pengguna" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                    </div>

                    <div class="mb-3">
    <label class="form-label fw-semibold">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
</div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
