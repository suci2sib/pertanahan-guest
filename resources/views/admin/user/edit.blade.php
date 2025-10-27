@extends('layouts.admin.user.app')

@section('content')
<section class="main-content">
    <div class="container-fluid py-5" style="background: linear-gradient(135deg, #f8d7e0, #fbe9d7);">
        <div class="container py-5">

            <h1 class="display-6 fw-bold text-danger mb-4">Edit User</h1>

            @include('layouts.admin.user.error')

            <div class="bg-white p-4 rounded-4 shadow-sm">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password (opsional)</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>

                    <div class="text-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
