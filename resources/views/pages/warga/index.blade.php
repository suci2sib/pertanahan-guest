@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="warga" class="section team-area">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn">Data Warga Desa</h3>
                <h2 class="wow fadeInUp">Daftar Penduduk Terdaftar</h2>
            </div>
            
            <div class="table-responsive">
                {{-- FORM FILTER & SEARCH --}}
                <form method="GET" action="{{ route('warga.index') }}" class="mb-4">
                    <div class="row g-2 justify-content-center">
                        <div class="col-md-3">
                            <select name="jenis_kelamin" class="form-select shadow-sm" onchange="this.form.submit()">
                                <option value="">- Semua Gender -</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control" 
                                    value="{{ request('search') }}" placeholder="Cari NIK / Nama / Telp...">
                                <button type="submit" class="btn btn-primary"><i class="lni lni-search-alt"></i> Cari</button>
                            </div>
                        </div>
                        @if(request()->has('search') || request()->has('jenis_kelamin'))
                        <div class="col-md-1">
                             <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary w-100" title="Reset"><i class="lni lni-reload"></i></a>
                        </div>
                        @endif
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success text-center shadow-sm mb-4">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger text-center shadow-sm mb-4">{{ session('error') }}</div>
                @endif

                <div class="text-center mb-4">
                    <a href="{{ route('warga.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="lni lni-plus"></i> Tambah Warga
                    </a>
                </div>

                {{-- CARD DATA --}}
                <div class="row justify-content-center">
                    @forelse ($dataWarga as $item)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team wow fadeInUp shadow-sm h-100 bg-white d-flex flex-column" 
                                 style="border-radius: 15px; overflow: hidden; border: 1px solid #f8f9fa;">
                                
                                <div class="p-4 text-center flex-grow-1">
                                    <div class="mb-3">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 70px; height: 70px;">
                                            <i class="lni lni-user text-primary" style="font-size: 30px;"></i>
                                        </div>
                                    </div>
                                    <h5 class="mb-1 fw-bold">{{ $item->nama }}</h5>
                                    <p class="text-muted small mb-2">{{ $item->no_ktp }}</p>
                                    <span class="badge {{ $item->jenis_kelamin == 'Laki-laki' ? 'bg-info' : 'bg-danger' }} rounded-pill px-3 mb-3">
                                        {{ $item->jenis_kelamin }}
                                    </span>
                                    <div class="text-start small bg-light p-3 rounded">
                                        <p class="mb-1"><i class="lni lni-phone me-2"></i> {{ $item->telp ?? '-' }}</p>
                                        <p class="mb-0"><i class="lni lni-briefcase me-2"></i> {{ $item->pekerjaan ?? '-' }}</p>
                                    </div>
                                </div>

                               {{-- TOMBOL EDIT/DELETE (ADMIN & SUPER ADMIN) --}}
                                {{-- PERBAIKAN: Kita izinkan 'Admin' DAN 'Super Admin' --}}
                                @if(Auth::check() && in_array(Auth::user()->role, ['Admin', 'Super Admin']))
                                    <div class="card-footer bg-white border-top-0 p-3 pt-0 mt-auto">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-warning btn-sm rounded-pill text-white px-3 shadow-sm">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" onsubmit="return confirm('Hapus data {{ $item->nama }}?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm">
                                                    <i class="lni lni-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <h5 class="text-muted">Data tidak ditemukan.</h5>
                        </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $dataWarga->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection