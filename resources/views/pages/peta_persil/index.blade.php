@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="datapeta" class="section team-area">
        <div class="container">

            <div class="section-title text-center">
                <h3 class="wow zoomIn">Data Peta Persil</h3>
                <h2 class="wow fadeInUp">Daftar Informasi Geospasial Lahan</h2>
            </div>

            <div class="table-responsive">
                {{-- SEARCH FORM --}}
                <form method="GET" action="{{ route('peta_persil.index') }}" class="mb-4">
                    <div class="row justify-content-center g-3">
                        <div class="col-md-6">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Cari Kode Persil atau Pemilik...">
                                <button type="submit" class="btn btn-primary"><i class="lni lni-search-alt"></i> Cari</button>
                            </div>
                        </div>
                        @if (request('search'))
                            <div class="col-md-2">
                                <a href="{{ route('peta_persil.index') }}" class="btn btn-secondary shadow-sm">Reset</a>
                            </div>
                        @endif
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success text-center mb-4 shadow-sm">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger text-center mb-4 shadow-sm">{{ session('error') }}</div>
                @endif

                <div class="text-center mb-5">
                    <a href="{{ route('peta_persil.create') }}" class="btn btn-primary rounded-pill px-4 shadow"><i class="lni lni-plus"></i> Tambah Peta Baru
                    </a>
                </div>

                {{-- CARD GRID --}}
                <div class="row justify-content-center">
                    {{-- Menggunakan $dataPeta dari Controller --}}
                    @forelse ($dataPeta as $peta)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team wow fadeInUp shadow-sm h-100 bg-white position-relative d-flex flex-column"
                                data-wow-delay=".2s"
                                style="border-radius: 15px; overflow: hidden; border: 1px solid #f0f0f0;">

                                {{-- Badge Jumlah File --}}
                                <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                                    <span class="badge bg-info rounded-pill shadow-sm p-2 text-white">
                                        <i class="lni lni-files"></i> {{ $peta->attachments->count() }}
                                    </span>
                                </div>

                                {{-- ICON/THUMBNAIL PETA --}}
                                <div style="height: 200px; overflow: hidden; background-color: #f8f8f8;" class="d-flex align-items-center justify-content-center border-bottom">
                                    <div class="text-center text-info">
                                        <i class="lni lni-map-marker-alt" style="font-size: 60px;"></i>
                                        <p class="small mt-2 text-dark">Data Peta</p>
                                    </div>
                                </div>

                                <div class="p-4 text-center flex-grow-1">
                                    <h4 class="mb-2 fw-bold text-dark">{{ $peta->persil->kode_persil ?? 'N/A' }}</h4>
                                    <p class="text-secondary small mb-3 badge bg-light text-dark border">
                                        Luas Est: {{ number_format($peta->panjang_m * $peta->lebar_m, 2) }} m²
                                    </p>

                                    <div class="text-start px-2 mt-3">
                                        {{-- Pemilik --}}
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-user me-1"></i> Pemilik</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 140px;">{{ $peta->persil->warga->nama ?? '-' }}</span>
                                        </div>
                                        {{-- Dimensi --}}
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-ruler me-1"></i> P x L (m)</span>
                                            <span class="fw-bold small">{{ number_format($peta->panjang_m, 2) }} x {{ number_format($peta->lebar_m, 2) }}</span>
                                        </div>
                                        {{-- GeoJSON Status --}}
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted small"><i class="lni lni-map me-1"></i> GeoJSON</span>
                                            <span class="fw-bold small text-end">
                                                @if ($peta->geojson)
                                                    <span class="badge bg-success">Ada Data</span>
                                                @else
                                                    <span class="badge bg-secondary">Kosong</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top-0 p-4 pt-0 mt-auto">
                                    <div class="d-flex justify-content-center flex-wrap gap-2">

                                        {{-- Tombol Detail (Memicu Modal) --}}
                                        <button type="button"
                                            class="btn btn-outline-info btn-sm rounded-pill px-3 fw-bold shadow-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetailPeta-{{ $peta->peta_id }}">
                                            <i class="lni lni-eye"></i> Detail
                                        </button>

                                        @if (Auth::check() && in_array(Auth::user()->role, ['Admin', 'Super Admin']))
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('peta_persil.edit', $peta->peta_id) }}" class="btn btn-warning btn-sm rounded-pill px-3 text-white shadow-sm">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>
                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('peta_persil.destroy', $peta->peta_id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus Data Peta ini? Semua file scan juga akan terhapus.');">
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

                        {{-- MODAL DETAIL PETA (Disisipkan di dalam loop) --}}
                        <div class="modal fade" id="modalDetailPeta-{{ $peta->peta_id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title text-white">Detail Peta Persil: {{ $peta->persil->kode_persil ?? 'N/A' }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-0">

                                        {{-- INFORMASI PETA --}}
                                        <div class="p-4 bg-light">
                                            <h6 class="fw-bold text-info mb-3"><i class="lni lni-map-marker-alt me-2"></i> Detail Dimensi & GeoJSON</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-borderless table-sm">
                                                        <tr><td class="text-muted w-50">Persil Terkait</td><td class="fw-bold">{{ $peta->persil->kode_persil ?? 'N/A' }}</td></tr>
                                                        <tr><td class="text-muted">Pemilik Lahan</td><td class="fw-bold">{{ $peta->persil->warga->nama ?? '-' }}</td></tr>
                                                        <tr><td class="text-muted">Panjang (m)</td><td>{{ number_format($peta->panjang_m, 2) ?? '-' }}</td></tr>
                                                        <tr><td class="text-muted">Lebar (m)</td><td>{{ number_format($peta->lebar_m, 2) ?? '-' }}</td></tr>
                                                        <tr><td class="text-muted">Luas Est. (m²)</td><td><span class="fw-bold text-success">{{ number_format($peta->panjang_m * $peta->lebar_m, 2) }}</span></td></tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="text-muted small">Data GeoJSON</h6>
                                                    @if ($peta->geojson)
                                                         <pre style="background: #f4f4f4; padding: 10px; border: 1px solid #ddd; max-height: 150px; overflow-y: auto; font-size: 10px; line-height: 1.2;">{{ json_encode($peta->geojson, JSON_PRETTY_PRINT) }}</pre>
                                                    @else
                                                        <p class="small border p-2 rounded bg-white text-muted fst-italic">Data GeoJSON belum diinput.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- BAGIAN FILE ATTACHMENT --}}
                                        <div class="p-4 bg-dark text-center" style="min-height: 200px;">
                                            <h6 class="fw-bold text-white mb-3"><i class="lni lni-image me-2"></i> Scan Peta & Lampiran File ({{ $peta->attachments->count() }})</h6>
                                            @if ($peta->attachments->count() > 0)
                                                <div class="row g-3 justify-content-center">
                                                    @foreach ($peta->attachments as $file)
                                                        <div class="col-md-3 col-6">
                                                            @if(str_contains($file->mime_type, 'image'))
                                                                <div class="position-relative bg-black rounded p-1">
                                                                    <img src="{{ asset('storage/uploads/peta_persil/' . $file->file_name) }}"
                                                                        class="img-fluid rounded"
                                                                        style="max-height: 150px; object-fit: contain;"
                                                                        alt="{{ $file->caption }}">
                                                                    <div class="text-white small mt-2 text-truncate" title="{{ $file->caption }}">{{ Str::limit($file->caption, 20) }}</div>
                                                                    <a href="{{ asset('storage/uploads/peta_persil/' . $file->file_name) }}" target="_blank" class="btn btn-xs btn-outline-light mt-1"><i class="lni lni-zoom-in"></i> View</a>
                                                                </div>
                                                            @else
                                                                <div class="p-4 bg-white rounded text-dark h-100 d-flex flex-column justify-content-center align-items-center">
                                                                    <i class="lni lni-files fs-1 text-danger mb-2"></i>
                                                                    <p class="mb-2 fw-bold small text-truncate" title="{{ $file->caption }}">{{ Str::limit($file->caption, 20) }}</p>
                                                                    <a href="{{ asset('storage/uploads/peta_persil/' . $file->file_name) }}" target="_blank" class="btn btn-xs btn-info text-white"><i class="lni lni-download"></i> Download</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="d-flex flex-column align-items-center justify-content-center text-white-50 py-5">
                                                    <i class="lni lni-map-marker-alt" style="font-size: 60px;"></i>
                                                    <p class="mt-2">Tidak ada scan peta/lampiran yang dilampirkan.</p>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="modal-footer bg-white">
                                        <a href="{{ route('peta_persil.edit', $peta->peta_id) }}" class="btn btn-warning btn-sm">Edit Data</a>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-5">
                            <div class="p-5 bg-light rounded border border-dashed">
                                <h5 class="text-muted">Belum ada data peta persil.</h5>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- PAGINATION PERSIS SCREENSHOT --}}
                @if($dataPeta->hasPages())
                <div class="d-flex flex-column align-items-center mt-5">
                    
                    {{-- INFO HASIL --}}
                    <div class="text-muted mb-3">
                        Showing {{ $dataPeta->firstItem() }}
                        to {{ $dataPeta->lastItem() }}
                        of {{ $dataPeta->total() }} results
                    </div>

                    {{-- PAGINATION NAVIGATION --}}
                    <div class="pagination-links">
                        {{ $dataPeta->links() }}
                    </div>

                </div>
                @endif

            </div>
        </div>
    </section>

    {{-- STYLE PAGINATION SEDERHANA SEPERTI SCREENSHOT --}}
    <style>
    /* PAGINATION STYLE SEDERHANA */
    .pagination-links {
        font-size: 14px;
    }

    .pagination-links .pagination {
        margin: 0;
        justify-content: center;
        gap: 4px;
    }

    .pagination-links .page-link {
        border: none;
        background: transparent;
        color: #333;
        padding: 6px 10px;
        text-decoration: none;
        border-radius: 0;
    }

    .pagination-links .page-link:hover {
        color: #000;
        background-color: #f5f5f5;
    }

    .pagination-links .page-item.active .page-link {
        font-weight: bold;
        color: #000;
        background: transparent;
    }

    .pagination-links .page-item.disabled .page-link {
        color: #999;
        background: transparent;
    }

    /* Text showing results */
    .text-muted {
        font-size: 14px;
        color: #666 !important;
        font-weight: 400;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .pagination-links .page-link {
            padding: 4px 8px;
            font-size: 13px;
        }
        
        .pagination-links .pagination {
            flex-wrap: wrap;
        }
    }

    /* Efek hover untuk card */
    .single-team {
        transition: all 0.3s ease;
    }

    .single-team:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    </style>

    {{-- JAVASCRIPT UNTUK MODAL --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi untuk card saat masuk viewport
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Terapkan ke semua card
        document.querySelectorAll('.single-team').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
        
        // Optimasi modal untuk mobile
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function() {
                const modalBody = this.querySelector('.modal-body');
                if (modalBody) {
                    modalBody.scrollTop = 0;
                }
            });
        });
    });
    </script>
@endsection