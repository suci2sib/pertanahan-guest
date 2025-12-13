@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="datapersil" class="section team-area">
        <div class="container">

            <div class="section-title text-center">
                <h3 class="wow zoomIn">Data Persil Desa</h3>
                <h2 class="wow fadeInUp">Daftar Persil / Bidang Tanah</h2>
            </div>

            <div class="table-responsive">
                {{-- SEARCH FORM --}}
                <form method="GET" action="{{ route('persil.index') }}" class="mb-4">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Cari Kode, Nama Pemilik, atau Alamat...">
                                <button type="submit" class="btn btn-primary"><i class="lni lni-search-alt"></i> Cari</button>
                                @if (request('search'))
                                    <a href="{{ route('persil.index') }}" class="btn btn-secondary">Reset</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success text-center mb-4 shadow-sm">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger text-center mb-4 shadow-sm">{{ session('error') }}</div>
                @endif

                <div class="text-center mb-5">
                    <a href="{{ route('persil.create') }}" class="btn btn-primary btn-lg rounded-pill px-4 shadow">
                        <i class="lni lni-plus"></i> Tambah Persil Baru
                    </a>
                </div>

                {{-- CARD GRID --}}
                <div class="row justify-content-center">
                    @forelse ($dataPersil as $p)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team wow fadeInUp shadow-sm h-100 bg-white position-relative d-flex flex-column"
                                data-wow-delay=".2s"
                                style="border-radius: 15px; overflow: hidden; border: 1px solid #f0f0f0;">

                                {{-- Badge Jumlah Foto --}}
                                <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                                    <span class="badge bg-primary rounded-pill shadow-sm p-2">
                                        <i class="lni lni-image"></i> {{ $p->attachments->count() }}
                                    </span>
                                </div>

                                {{-- GAMBAR THUMBNAIL DI CARD (Ambil gambar pertama atau Placeholder) --}}
                                <div style="height: 200px; overflow: hidden; background-color: #eee;" class="d-flex align-items-center justify-content-center border-bottom">
                                    @if ($p->attachments->count() > 0)
                                        {{-- Ambil gambar pertama sebagai cover --}}
                                        @php $firstImg = $p->attachments->first(); @endphp
                                        @if(str_contains($firstImg->mime_type, 'image'))
                                            <img src="{{ asset('storage/uploads/persil/' . $firstImg->file_name) }}" 
                                                 alt="Cover" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            {{-- Jika filenya PDF/Doc, tampilkan icon dokumen --}}
                                            <div class="text-center text-secondary">
                                                <i class="lni lni-files" style="font-size: 60px;"></i>
                                                <p class="small mt-2">Dokumen Terlampir</p>
                                            </div>
                                        @endif
                                    @else
                                        {{-- Placeholder jika tidak ada gambar --}}
                                        <div class="text-center text-muted">
                                            <i class="lni lni-image" style="font-size: 50px; opacity: 0.3;"></i>
                                            <p class="small m-0 text-muted">No Image</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-4 text-center flex-grow-1">
                                    <h4 class="mb-2 fw-bold text-dark">{{ $p->kode_persil }}</h4>
                                    <p class="text-secondary small mb-3 badge bg-light text-dark border">{{ $p->penggunaan }}</p>
                                    
                                    <div class="text-start px-2 mt-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-user me-1"></i> Pemilik</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 140px;">{{ $p->warga->nama ?? '-' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-ruler me-1"></i> Luas</span>
                                            <span class="fw-bold small">{{ $p->luas_m2 }} m²</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted small"><i class="lni lni-map-marker me-1"></i> Lokasi</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 140px;">{{ $p->alamat_lahan }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top-0 p-4 pt-0 mt-auto">
                                    <div class="d-flex justify-content-center flex-wrap gap-2">
                                        <button type="button" class="btn btn-outline-info btn-sm rounded-pill px-3 fw-bold"
                                            data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $p->persil_id }}">
                                            <i class="lni lni-eye"></i> Detail
                                        </button>

                                        @if (Auth::check() && in_array(Auth::user()->role, ['Admin', 'Super Admin']))
                                            <a href="{{ route('persil.edit', $p->persil_id) }}" class="btn btn-warning btn-sm rounded-pill px-3 text-white shadow-sm">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('persil.destroy', $p->persil_id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus Persil {{ $p->kode_persil }}?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm">
                                                    <i class="lni lni-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL DETAIL (Full Image View) --}}
                        <div class="modal fade" id="modalDetail-{{ $p->persil_id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title text-white">Detail Persil: {{ $p->kode_persil }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        {{-- Bagian Gambar (Scrollable) --}}
                                        <div class="bg-dark text-center p-3" style="min-height: 250px;">
                                            @if ($p->attachments->count() > 0)
                                                <div class="row g-3 justify-content-center">
                                                    @foreach ($p->attachments as $file)
                                                        <div class="col-md-6 col-12">
                                                            @if(str_contains($file->mime_type, 'image'))
                                                                <div class="position-relative bg-black rounded p-1">
                                                                    <img src="{{ asset('storage/uploads/persil/' . $file->file_name) }}" 
                                                                         class="img-fluid rounded" 
                                                                         style="max-height: 300px; object-fit: contain;"
                                                                         alt="{{ $file->caption }}">
                                                                    <div class="text-white small mt-2">{{ $file->caption }}</div>
                                                                    <a href="{{ asset('storage/uploads/persil/' . $file->file_name) }}" target="_blank" class="btn btn-xs btn-outline-light mt-1"><i class="lni lni-zoom-in"></i> Full Size</a>
                                                                </div>
                                                            @else
                                                                {{-- Jika PDF/File Lain --}}
                                                                <div class="p-5 bg-white rounded text-dark mt-2 h-100 d-flex flex-column justify-content-center align-items-center">
                                                                    <i class="lni lni-files fs-1 text-danger mb-2"></i>
                                                                    <p class="mb-2 fw-bold">{{ $file->caption }}</p>
                                                                    <a href="{{ asset('storage/uploads/persil/' . $file->file_name) }}" target="_blank" class="btn btn-sm btn-primary">
                                                                        <i class="lni lni-download"></i> Download/Lihat File
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                {{-- Placeholder di Modal --}}
                                                <div class="d-flex flex-column align-items-center justify-content-center text-white-50 py-5">
                                                    <i class="lni lni-image" style="font-size: 60px;"></i>
                                                    <p class="mt-2">Tidak ada foto/lampiran untuk persil ini.</p>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Informasi Detail --}}
                                        <div class="p-4 bg-light">
                                            <h6 class="fw-bold text-primary mb-3"><i class="lni lni-list me-2"></i> Informasi Lengkap</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-borderless table-sm">
                                                        <tr><td class="text-muted w-50">Pemilik</td><td class="fw-bold">{{ $p->warga->nama ?? '-' }}</td></tr>
                                                        <tr><td class="text-muted">NIK</td><td>{{ $p->warga->no_ktp ?? '-' }}</td></tr>
                                                        <tr><td class="text-muted">Kode Persil</td><td class="fw-bold">{{ $p->kode_persil }}</td></tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-borderless table-sm">
                                                        <tr><td class="text-muted w-50">Luas Tanah</td><td class="fw-bold">{{ $p->luas_m2 }} m²</td></tr>
                                                        <tr><td class="text-muted">Penggunaan</td><td><span class="badge bg-secondary">{{ $p->penggunaan }}</span></td></tr>
                                                        <tr><td class="text-muted">Alamat</td><td>{{ $p->alamat_lahan }} (RT {{ $p->rt }}/RW {{ $p->rw }})</td></tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-white">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-5">
                            <div class="p-5 bg-light rounded border border-dashed">
                                <h5 class="text-muted">Belum ada data persil.</h5>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $dataPersil->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection