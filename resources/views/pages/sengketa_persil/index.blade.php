@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="datasengketa" class="section team-area">
        <div class="container">

            <div class="section-title text-center">
                <h3 class="wow zoomIn">Data Sengketa Persil</h3>
                <h2 class="wow fadeInUp">Daftar Laporan Sengketa Tanah</h2>
            </div>

            <div class="table-responsive">
                {{-- SEARCH FORM & FILTER (Diadaptasi dari template dokumen_persil) --}}
                <form method="GET" action="{{ route('sengketa_persil.index') }}" class="mb-4">
                    <div class="row justify-content-center g-3">
                        <div class="col-md-5">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Cari Pihak 1, Pihak 2, atau Kronologi...">
                                <button type="submit" class="btn btn-primary"><i class="lni lni-search-alt"></i> Cari</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                             <select name="status" class="form-select shadow-sm" onchange="this.form.submit()">
                                <option value="">-- Filter Status --</option>
                                @foreach (['diproses', 'diterima', 'ditolak'] as $s)
                                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if (request('search') || request('status'))
                            <div class="col-md-2">
                                <a href="{{ route('sengketa_persil.index') }}" class="btn btn-secondary shadow-sm">Reset</a>
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
                    <a href="{{ route('sengketa_persil.create') }}" class="btn btn-primary btn-lg rounded-pill px-4 shadow">
                        <i class="lni lni-plus"></i> Laporkan Sengketa Baru
                    </a>
                </div>

                {{-- CARD GRID --}}
                <div class="row justify-content-center">
                    {{-- Menggunakan $dataSengketa dari Controller --}}
                    @forelse ($dataSengketa as $s)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team wow fadeInUp shadow-sm h-100 bg-white position-relative d-flex flex-column"
                                data-wow-delay=".2s"
                                style="border-radius: 15px; overflow: hidden; border: 1px solid #f0f0f0;">

                                {{-- Badge Jumlah File --}}
                                <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                                    <span class="badge bg-danger rounded-pill shadow-sm p-2">
                                        <i class="lni lni-files"></i> {{ $s->attachments->count() }}
                                    </span>
                                </div>

                                {{-- ICON STATUS --}}
                                @php
                                    $icon = match($s->status) {
                                        'diterima' => ['lni lni-check-mark-circle', 'bg-success'],
                                        'ditolak' => ['lni lni-cross-circle', 'bg-danger'],
                                        default => ['lni lni-timer', 'bg-warning text-dark'],
                                    };
                                @endphp
                                <div style="height: 200px; overflow: hidden; background-color: #eee;" class="d-flex align-items-center justify-content-center border-bottom">
                                    <div class="text-center {{ $icon[1] }}">
                                        <i class="{{ $icon[0] }}" style="font-size: 60px;"></i>
                                        <p class="small mt-2 text-dark">{{ ucfirst($s->status) }}</p>
                                    </div>
                                </div>

                                <div class="p-4 text-center flex-grow-1">
                                    <h5 class="mb-2 fw-bold text-dark text-truncate" title="Kronologi: {{ $s->kronologi }}">{{ Str::limit($s->kronologi, 30) }}</h5>
                                    <p class="text-secondary small mb-3 badge bg-light text-dark border">{{ $s->pihak_1 }} vs {{ $s->pihak_2 ?? 'Lahan' }}</p>

                                    <div class="text-start px-2 mt-3">
                                        {{-- Persil Terkait --}}
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-layers me-1"></i> Persil</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 140px;">{{ $s->persil->kode_persil ?? 'Persil Dihapus' }}</span>
                                        </div>
                                        {{-- Pemilik --}}
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-user me-1"></i> Pemilik Lahan</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 140px;">{{ $s->persil->warga->nama ?? '-' }}</span>
                                        </div>
                                        {{-- Penyelesaian Singkat --}}
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted small"><i class="lni lni-comments me-1"></i> Keputusan</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 140px;">{{ $s->penyelesaian ? Str::limit($s->penyelesaian, 15) : 'Belum Ada' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top-0 p-4 pt-0 mt-auto">
                                    <div class="d-flex justify-content-center flex-wrap gap-2">

                                        {{-- Tombol Detail (Memicu Modal) --}}
                                        <button type="button"
                                            class="btn btn-outline-info btn-sm rounded-pill px-3 fw-bold shadow-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetailSengketa-{{ $s->sengketa_id }}">
                                            <i class="lni lni-eye"></i> Detail
                                        </button>

                                        @if (Auth::check() && in_array(Auth::user()->role, ['Admin', 'Super Admin']))
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('sengketa_persil.edit', $s->sengketa_id) }}" class="btn btn-warning btn-sm rounded-pill px-3 text-white shadow-sm">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>
                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('sengketa_persil.destroy', $s->sengketa_id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus Laporan Sengketa ini? Semua bukti lampiran akan terhapus.');">
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

                        {{-- MODAL DETAIL SENGKETA (Disisipkan di dalam loop) --}}
                        <div class="modal fade" id="modalDetailSengketa-{{ $s->sengketa_id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title text-white">Detail Sengketa: {{ $s->pihak_1 }} vs {{ $s->pihak_2 ?? 'Lahan' }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-0">

                                        {{-- INFORMASI SENGKETA --}}
                                        <div class="p-4 bg-light">
                                            <h6 class="fw-bold text-danger mb-3"><i class="lni lni-warning me-2"></i> Status & Kronologi</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-borderless table-sm">
                                                        <tr><td class="text-muted w-50">Persil Terkait</td><td class="fw-bold">{{ $s->persil->kode_persil ?? 'N/A' }}</td></tr>
                                                        <tr><td class="text-muted">Pemilik Lahan</td><td class="fw-bold">{{ $s->persil->warga->nama ?? '-' }}</td></tr>
                                                        <tr><td class="text-muted">Pihak 1 (Penggugat)</td><td class="fw-bold">{{ $s->pihak_1 }}</td></tr>
                                                        <tr><td class="text-muted">Pihak 2 (Tergugat)</td><td>{{ $s->pihak_2 ?? '-' }}</td></tr>
                                                        <tr><td class="text-muted">Status</td><td><span class="badge {{ $icon[1] }}">{{ ucfirst($s->status) }}</span></td></tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="text-muted small">Kronologi</h6>
                                                    <p class="small border p-2 rounded bg-white">{{ $s->kronologi }}</p>
                                                    <h6 class="text-muted small mt-3">Keputusan/Penyelesaian</h6>
                                                    <p class="small border p-2 rounded bg-white {{ $s->penyelesaian ? '' : 'text-muted fst-italic' }}">{{ $s->penyelesaian ?? 'Belum Ada Keputusan Final' }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- BAGIAN FILE ATTACHMENT --}}
                                        <div class="p-4 bg-dark text-center" style="min-height: 200px;">
                                            <h6 class="fw-bold text-white mb-3"><i class="lni lni-image me-2"></i> Bukti dan Lampiran File ({{ $s->attachments->count() }})</h6>
                                            @if ($s->attachments->count() > 0)
                                                <div class="row g-3 justify-content-center">
                                                    @foreach ($s->attachments as $file)
                                                        <div class="col-md-3 col-6">
                                                            @if(str_contains($file->mime_type, 'image'))
                                                                <div class="position-relative bg-black rounded p-1">
                                                                    <img src="{{ asset('storage/uploads/sengketa_persil/' . $file->file_name) }}"
                                                                        class="img-fluid rounded"
                                                                        style="max-height: 150px; object-fit: contain;"
                                                                        alt="{{ $file->caption }}">
                                                                    <div class="text-white small mt-2 text-truncate" title="{{ $file->caption }}">{{ Str::limit($file->caption, 20) }}</div>
                                                                    <a href="{{ asset('storage/uploads/sengketa_persil/' . $file->file_name) }}" target="_blank" class="btn btn-xs btn-outline-light mt-1"><i class="lni lni-zoom-in"></i> View</a>
                                                                </div>
                                                            @else
                                                                <div class="p-4 bg-white rounded text-dark h-100 d-flex flex-column justify-content-center align-items-center">
                                                                    <i class="lni lni-files fs-1 text-danger mb-2"></i>
                                                                    <p class="mb-2 fw-bold small text-truncate" title="{{ $file->caption }}">{{ Str::limit($file->caption, 20) }}</p>
                                                                    <a href="{{ asset('storage/uploads/sengketa_persil/' . $file->file_name) }}" target="_blank" class="btn btn-xs btn-primary"><i class="lni lni-download"></i> Download</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="d-flex flex-column align-items-center justify-content-center text-white-50 py-5">
                                                    <i class="lni lni-image" style="font-size: 60px;"></i>
                                                    <p class="mt-2">Tidak ada bukti/lampiran yang dilampirkan.</p>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="modal-footer bg-white">
                                        <a href="{{ route('sengketa_persil.edit', $s->sengketa_id) }}" class="btn btn-warning btn-sm">Edit Data</a>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-5">
                            <div class="p-5 bg-light rounded border border-dashed">
                                <h5 class="text-muted">Belum ada data sengketa persil.</h5>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $dataSengketa->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
