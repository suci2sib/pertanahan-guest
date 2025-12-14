@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="datadokumen" class="section team-area">
        <div class="container">

            {{-- ... (Bagian Title, Search Form, Alerts, dan Tombol Tambah TIDAK DIUBAH) ... --}}

            <div class="table-responsive">
                {{-- SEARCH FORM --}}
                <form method="GET" action="{{ route('dokumen_persil.index') }}" class="mb-4">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Cari Jenis Dokumen, Nomor, atau Keterangan...">
                                <button type="submit" class="btn btn-primary"><i class="lni lni-search-alt"></i> Cari</button>
                                @if (request('search'))
                                    <a href="{{ route('dokumen_persil.index') }}" class="btn btn-secondary">Reset</a>
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
                    <a href="{{ route('dokumen_persil.create') }}" class="btn btn-primary btn-lg rounded-pill px-4 shadow">
                        <i class="lni lni-plus"></i> Tambah Dokumen Baru
                    </a>
                </div>

                {{-- CARD GRID --}}
                <div class="row justify-content-center">
                    {{-- Menggunakan $dataDokumen dari Controller --}}
                    @forelse ($dataDokumen as $d)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team wow fadeInUp shadow-sm h-100 bg-white position-relative d-flex flex-column"
                                data-wow-delay=".2s"
                                style="border-radius: 15px; overflow: hidden; border: 1px solid #f0f0f0;">

                                {{-- Badge Jumlah File --}}
                                <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                                    <span class="badge bg-primary rounded-pill shadow-sm p-2">
                                        <i class="lni lni-files"></i> {{ $d->attachments->count() }}
                                    </span>
                                </div>

                                {{-- ICON DOKUMEN THUMBNAIL --}}
                                <div style="height: 200px; overflow: hidden; background-color: #eee;" class="d-flex align-items-center justify-content-center border-bottom">
                                    <div class="text-center text-primary">
                                        <i class="lni lni-files" style="font-size: 60px;"></i>
                                        <p class="small mt-2 text-dark">{{ $d->jenis_dokumen }}</p>
                                    </div>
                                </div>

                                <div class="p-4 text-center flex-grow-1">
                                    <h4 class="mb-2 fw-bold text-dark">{{ $d->nomor ?? 'Tidak Bernomor' }}</h4>
                                    <p class="text-secondary small mb-3 badge bg-light text-dark border">{{ $d->jenis_dokumen }}</p>

                                    <div class="text-start px-2 mt-3">
                                        {{-- Persil Terkait --}}
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-layers me-1"></i> Persil</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 140px;">{{ $d->persil->kode_persil ?? 'Persil Dihapus' }}</span>
                                        </div>
                                        {{-- Pemilik --}}
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-user me-1"></i> Pemilik Lahan</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 140px;">{{ $d->persil->warga->nama ?? '-' }}</span>
                                        </div>
                                        {{-- Keterangan --}}
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted small"><i class="lni lni-comments me-1"></i> Keterangan</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 140px;">{{ $d->keterangan ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-white border-top-0 p-4 pt-0 mt-auto">
                                    <div class="d-flex justify-content-center flex-wrap gap-2">

                                        {{-- PERUBAHAN UTAMA: Tombol Detail diubah menjadi Pemicu Modal --}}
                                        <button type="button"
                                            class="btn btn-outline-info btn-sm rounded-pill px-3 fw-bold shadow-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetailDokumen-{{ $d->dokumen_id }}">
                                            <i class="lni lni-eye"></i> Detail
                                        </button>

                                        @if (Auth::check() && in_array(Auth::user()->role, ['Admin', 'Super Admin']))
                                            {{-- Tombol Edit (Diubah ke edit dokumen_persil) --}}
                                            <a href="{{ route('dokumen_persil.edit', $d->dokumen_id) }}" class="btn btn-warning btn-sm rounded-pill px-3 text-white shadow-sm">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>
                                            {{-- Tombol Hapus (Diubah ke destroy dokumen_persil) --}}
                                            <form action="{{ route('dokumen_persil.destroy', $d->dokumen_id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus Dokumen {{ $d->jenis_dokumen }}? Semua lampiran juga akan terhapus.');">
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

                        {{-- MODAL DETAIL DOKUMEN (Disisipkan di dalam loop) --}}
                        <div class="modal fade" id="modalDetailDokumen-{{ $d->dokumen_id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title text-white">Detail Dokumen: {{ $d->nomor ?? 'Tidak Bernomor' }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        {{-- Bagian File Attachment (Scrollable) --}}
                                        <div class="bg-dark text-center p-3" style="min-height: 250px;">
                                            @if ($d->attachments->count() > 0)
                                                <div class="row g-3 justify-content-center">
                                                    @foreach ($d->attachments as $file)
                                                        <div class="col-md-4 col-12">
                                                            @if(str_contains($file->mime_type, 'image'))
                                                                <div class="position-relative bg-black rounded p-1">
                                                                    <img src="{{ asset('storage/uploads/dokumen_persil/' . $file->file_name) }}"
                                                                        class="img-fluid rounded"
                                                                        style="max-height: 250px; object-fit: contain;"
                                                                        alt="{{ $file->caption }}">
                                                                    <div class="text-white small mt-2">{{ $file->caption }}</div>
                                                                    <a href="{{ asset('storage/uploads/dokumen_persil/' . $file->file_name) }}" target="_blank" class="btn btn-xs btn-outline-light mt-1"><i class="lni lni-zoom-in"></i> Full Size</a>
                                                                </div>
                                                            @else
                                                                {{-- Jika PDF/File Lain --}}
                                                                <div class="p-4 bg-white rounded text-dark mt-2 h-100 d-flex flex-column justify-content-center align-items-center">
                                                                    <i class="lni lni-files fs-1 text-danger mb-2"></i>
                                                                    <p class="mb-2 fw-bold">{{ $file->caption }}</p>
                                                                    <a href="{{ asset('storage/uploads/dokumen_persil/' . $file->file_name) }}" target="_blank" class="btn btn-sm btn-primary">
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
                                                    <p class="mt-2">Tidak ada foto/lampiran untuk dokumen ini.</p>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Informasi Detail Dokumen --}}
                                        <div class="p-4 bg-light">
                                            <h6 class="fw-bold text-info mb-3"><i class="lni lni-list me-2"></i> Informasi Dokumen</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table table-borderless table-sm">
                                                        <tr><td class="text-muted w-50">Jenis Dokumen</td><td class="fw-bold">{{ $d->jenis_dokumen }}</td></tr>
                                                        <tr><td class="text-muted">Nomor Dokumen</td><td class="fw-bold">{{ $d->nomor ?? '-' }}</td></tr>
                                                        <tr><td class="text-muted">Tanggal Terbit</td><td class="fw-bold">{{ $d->tanggal_terbit ? \Carbon\Carbon::parse($d->tanggal_terbit)->isoFormat('D MMMM YYYY') : '-' }}</td></tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-borderless table-sm">
                                                        <tr><td class="text-muted w-50">Persil Terkait</td><td class="fw-bold">{{ $d->persil->kode_persil ?? 'Persil Dihapus' }}</td></tr>
                                                        <tr><td class="text-muted">Pemilik Lahan</td><td>{{ $d->persil->warga->nama ?? '-' }}</td></tr>
                                                        <tr><td class="text-muted">Keterangan</td><td>{{ $d->keterangan ?? '-' }}</td></tr>
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
                        {{-- ... (Placeholder Empty) ... --}}
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $dataDokumen->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
