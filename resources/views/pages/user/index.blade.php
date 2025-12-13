@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="user" class="section team-area">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn">Data User</h3>
                <h2 class="wow fadeInUp">Daftar Pengguna Sistem</h2>
            </div>

            <div class="table-responsive">
                {{-- SEARCH --}}
                <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control"
                                    value="{{ request('search') }}" placeholder="Cari Nama / Email / Role">
                                <button type="submit" class="btn btn-primary"><i class="lni lni-search-alt"></i></button>
                                @if (request('search'))
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Reset</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

                @if (session('success')) <div class="alert alert-success text-center">{{ session('success') }}</div> @endif
                @if (session('error')) <div class="alert alert-danger text-center">{{ session('error') }}</div> @endif

                <div class="text-center mb-4">
                    <a href="{{ route('user.create') }}" class="btn btn-primary rounded-pill px-4"><i class="lni lni-plus"></i> Tambah User</a>
                </div>

                <div class="row justify-content-center">
                    @forelse ($dataUser as $item)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team shadow-sm bg-white d-flex flex-column h-100" style="border-radius: 15px; border: 1px solid #eee;">
                                <div class="p-4 text-center flex-grow-1">
                                    <div class="mb-3">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 70px; height: 70px;">
                                            <i class="lni lni-user text-primary" style="font-size: 30px;"></i>
                                        </div>
                                    </div>

                                    <h5 class="mb-1 fw-bold">{{ $item->name }}</h5>
                                    <p class="text-muted small mb-2">{{ $item->email }}</p>
                                    
                                    @php
                                        $badgeClass = match($item->role) {
                                            'Super Admin' => 'bg-dark',
                                            'Admin' => 'bg-primary',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ $item->role }}</span>
                                </div>

                                {{-- ACTION BUTTONS --}}
                                @if (Auth::user()->role === 'Super Admin')
                                    <div class="card-footer bg-white border-top-0 p-3 pt-0 mt-auto">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm rounded-pill px-4 text-white shadow-sm">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>

                                            @if(Auth::id() !== $item->id)
                                                <form action="{{ route('user.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus user {{ $item->name }}?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4 shadow-sm">
                                                        <i class="lni lni-trash-can"></i> Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm rounded-pill px-3 disabled" disabled><i class="lni lni-lock"></i> Saya</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-4"><p class="text-muted">Data user tidak ditemukan.</p></div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $dataUser->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection