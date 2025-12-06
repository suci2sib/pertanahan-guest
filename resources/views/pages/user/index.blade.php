@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="user" class="section team-area">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Data User</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Daftar Pengguna Sistem</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Berikut adalah daftar user yang memiliki akses ke sistem ini.
                </p>
            </div>

            <div class="table-responsive">
                {{-- Search --}}
                <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    value="{{ request('search') }}" placeholder="Search">
                                <button type="submit" class="input-group-text">
                                    🔍
                                </button>
                                @if (request('search'))
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                        class="btn btn-outline-secondary ml-3">Clear</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tombol tambah user hanya untuk Admin --}}
                    <div class="text-center mb-4">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">
                            <i class="lni lni-plus"></i> Tambah User
                        </a>
                    </div>
  

                <div class="row justify-content-center">
                    @forelse ($dataUser as $item)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team shadow-sm" style="border-radius: 15px;">
                                <div class="p-4 bg-white text-center">

                                    <div class="mb-3">
                                        <i class="lni lni-user" style="font-size: 50px; color: #007bff;"></i>
                                    </div>

                                    <h4 class="mb-1">{{ $item->name }}</h4>
                                    <p class="text-muted mb-2">{{ $item->email }}</p>

                                    <ul class="list-unstyled mb-3">
                                        <li><i class="lni lni-key"></i> ID: {{ $item->id }}</li>
                                        <li><i class="lni lni-shield"></i> Role: {{ $item->role }}</li>
                                    </ul>

                                    {{-- Tombol Edit & Hapus hanya untuk Admin --}}
                                    @if (Auth::user()->role === 'Admin')
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('user.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm me-2">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>

                                            <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="lni lni-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-4">
                            <p class="text-muted">Belum ada data user.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-3">
                    {{ $dataUser->links('pagination::simple-bootstrap-5') }}
                </div>

            </div>
        </div>
    </section>
@endsection
