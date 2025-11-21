@extends('layouts.guest.app')

@section('content')
    <!-- Daftar User -->
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
                <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                    value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                                <button type="submit" class="input-group-text" id="basic-addon2">
                                    <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                @if (request('search'))
                                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                        class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <i class="lni lni-checkmark-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Tombol tambah user --}}
                <div class="text-center mb-4">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">
                        <i class="lni lni-plus"></i> Tambah User
                    </a>
                </div>

                <div class="row justify-content-center">
                    @forelse ($dataUser as $item)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team wow fadeInUp shadow-sm" data-wow-delay=".2s"
                                style="border-radius: 15px; overflow: hidden;">
                                <div class="p-4 bg-white text-center">
                                    <div class="mb-3">
                                        <i class="lni lni-user" style="font-size: 50px; color: #007bff;"></i>
                                    </div>
                                    <h4 class="mb-1">{{ $item->name }}</h4>
                                    <p class="text-muted mb-2">{{ $item->email }}</p>

                                    <ul class="list-unstyled mb-3">
                                        <li><i class="lni lni-key"></i> ID: {{ $item->id }}</li>
                                    </ul>

                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm me-2">
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
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-4">
                            <p class="text-muted">Belum ada data user yang terdaftar.</p>
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
