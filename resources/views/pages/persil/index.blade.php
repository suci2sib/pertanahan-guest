@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="datapersil" class="section team-area">
        <div class="container">

            <!-- Judul -->
            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Data Persil Desa</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Daftar Persil / Bidang Tanah</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Berikut adalah daftar seluruh persil tanah yang terdata dalam sistem desa.
                </p>
            </div>
            <div class="table-responsive">
                <form method="GET" action="{{ route('persil.index') }}" class="mb-3">
                    <div class="row">
                        {{-- FILTER DROPDOWN (Jenis Penggunaan) --}}


                        {{-- SEARCH INPUT --}}
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Cari Penggunaan / Alamat..." aria-label="Search">

                                <button type="submit" class="input-group-text">
                                    <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>

                                @if (request('search') || request('jenis_id'))
                                    <a href="{{ route('persil.index') }}" class="btn btn-outline-secondary ms-2">
                                        Reset
                                    </a>
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

                {{-- Tombol Tambah --}}
                <div class="text-center mb-4">
                    <a href="{{ route('persil.create') }}" class="btn btn-primary">
                        <i class="lni lni-plus"></i> Tambah Persil Baru
                    </a>
                </div>

                <div class="row justify-content-center">
                    @forelse ($dataPersil as $p)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team wow fadeInUp shadow-sm" data-wow-delay=".2s"
                                style="border-radius: 15px; overflow: hidden;">

                                <div class="p-4 bg-white text-center">

                                    <!-- Icon -->
                                    <div class="mb-3">
                                        <i class="lni lni-map-marker" style="font-size: 50px; color: #007bff;"></i>
                                    </div>

                                    <!-- Data Persil -->
                                    <h4 class="mb-1">Kode: {{ $p->kode_persil }}</h4>

                                    <p class="text-muted mb-1">
                                        <strong>Pemilik:</strong>
                                        {{ $p->warga->nama ?? 'Tidak Ada' }}
                                    </p>

                                    <p class="text-muted mb-1">
                                        <strong>Luas:</strong> {{ $p->luas_m2 }} m²
                                    </p>

                                    <p class="text-muted mb-1">
                                        <strong>Penggunaan:</strong> {{ $p->penggunaan }}
                                    </p>

                                    <p class="text-muted mb-3">
                                        <strong>Alamat:</strong> {{ $p->alamat_lahan }}
                                        (RT {{ $p->rt }} / RW {{ $p->rw }})
                                    </p>

                                    <!-- Tombol Edit & Hapus -->
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('persil.edit', $p->persil_id) }}"
                                            class="btn btn-warning btn-sm me-2">
                                            <i class="lni lni-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('persil.destroy', $p->persil_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                            <p class="text-muted">Belum ada data persil yang terdaftar.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $dataPersil->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
    </section>
@endsection
