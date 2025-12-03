@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="datapersil" class="section team-area">
        <div class="container">

            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Data Persil Desa</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Daftar Persil / Bidang Tanah</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Berikut adalah daftar seluruh persil tanah yang terdata dalam sistem desa.
                </p>
            </div>

            <div class="table-responsive">
                <form method="GET" action="{{ route('persil.index') }}" class="mb-4">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                    placeholder="Cari Kode Persil / Pemilik / Alamat..." aria-label="Search">
                                <button type="submit" class="input-group-text btn-primary text-white">
                                    <i class="lni lni-search-alt"></i> Cari
                                </button>
                                @if (request('search'))
                                    <a href="{{ route('persil.index') }}" class="btn btn-secondary">Reset</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Pesan Sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show text-center shadow-sm" role="alert">
                        <i class="lni lni-checkmark-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Tombol Tambah --}}
                <div class="text-center mb-5">
                    <a href="{{ route('persil.create') }}" class="btn btn-primary btn-lg rounded-pill px-4 shadow">
                        <i class="lni lni-plus"></i> Tambah Persil Baru
                    </a>
                </div>

                {{-- GRID DATA PERSIL --}}
                <div class="row justify-content-center">
                    @forelse ($dataPersil as $p)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team wow fadeInUp shadow-sm h-100 bg-white position-relative"
                                data-wow-delay=".2s" style="border-radius: 15px; overflow: hidden; border: 1px solid #f0f0f0;">

                                {{-- Indikator Lampiran (Badge) --}}
                                @if ($p->attachments->count() > 0)
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-info text-white rounded-pill shadow-sm" title="Memiliki Lampiran">
                                            <i class="lni lni-paperclip"></i> {{ $p->attachments->count() }} Berkas
                                        </span>
                                    </div>
                                @endif

                                <div class="p-4 text-center d-flex flex-column h-100">



                                    <h4 class="mb-2 text-dark">{{ $p->kode_persil }}</h4>
                                    <p class="text-muted small mb-3">{{ $p->penggunaan }}</p>

                                    <hr class="w-50 mx-auto opacity-25">

                                    <div class="text-start px-3 mb-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-user me-1"></i> Pemilik</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 150px;">
                                                {{ $p->warga->nama ?? '-' }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted small"><i class="lni lni-ruler me-1"></i> Luas</span>
                                            <span class="fw-bold small">{{ $p->luas_m2 }} m²</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted small"><i class="lni lni-home me-1"></i> Lokasi</span>
                                            <span class="fw-bold small text-end text-truncate" style="max-width: 150px;">
                                                RT {{ $p->rt }}/RW {{ $p->rw }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div class="mt-auto d-flex justify-content-center gap-2">
                                        {{-- Tombol Detail (Trigger Modal) --}}
                                        <button type="button" class="btn btn-outline-info btn-sm rounded-pill px-3"
                                            data-bs-toggle="modal" data-bs-target="#modalDetail-{{ $p->persil_id }}">
                                            <i class="lni lni-eye"></i> Detail
                                        </button>

                                        <a href="{{ route('persil.edit', $p->persil_id) }}"
                                            class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                            <i class="lni lni-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('persil.destroy', $p->persil_id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                <i class="lni lni-trash-can">Hapus</i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- ============================== --}}
                        {{-- MODAL DETAIL (POP-UP) --}}
                        {{-- ============================== --}}
                        <div class="modal fade" id="modalDetail-{{ $p->persil_id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title text-white">
                                            <i class="lni lni-map me-2"></i> Detail Persil: {{ $p->kode_persil }}
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 bg-light">
                                        <div class="row g-4">
                                            {{-- Kolom Kiri: Info Utama --}}
                                            <div class="col-md-6">
                                                <div class="bg-white p-3 rounded shadow-sm h-100">
                                                    <h6 class="fw-bold border-bottom pb-2 mb-3 text-primary">Informasi Lahan</h6>

                                                    <table class="table table-borderless table-sm">
                                                        <tr>
                                                            <td class="text-muted w-50">Kode Persil</td>
                                                            <td class="fw-bold">{{ $p->kode_persil }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Nama Pemilik</td>
                                                            <td class="fw-bold">{{ $p->warga->nama ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">NIK Pemilik</td>
                                                            <td>{{ $p->warga->no_ktp ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Luas Tanah</td>
                                                            <td class="fw-bold">{{ $p->luas_m2 }} m²</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Penggunaan</td>
                                                            <td><span class="badge bg-secondary">{{ $p->penggunaan }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Alamat</td>
                                                            <td>{{ $p->alamat_lahan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Wilayah</td>
                                                            <td>RT {{ $p->rt }} / RW {{ $p->rw }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            {{-- Kolom Kanan: Lampiran --}}
                                            <div class="col-md-6">
                                                <div class="bg-white p-3 rounded shadow-sm h-100">
                                                    <h6 class="fw-bold border-bottom pb-2 mb-3 text-primary">
                                                        <i class="lni lni-files me-1"></i> Berkas Lampiran
                                                    </h6>

                                                    @if ($p->attachments->count() > 0)
                                                        <div class="d-flex flex-column gap-2" style="max-height: 300px; overflow-y: auto;">
                                                            @foreach ($p->attachments as $file)
                                                                <div class="d-flex align-items-center p-2 border rounded bg-light hover-shadow">
                                                                    {{-- Ikon berdasarkan tipe file --}}
                                                                    <div class="me-3 text-center" style="width: 40px;">
                                                                        @if (str_contains($file->mime_type, 'image'))
                                                                            <i class="lni lni-image text-success fs-3"></i>
                                                                        @elseif(str_contains($file->mime_type, 'pdf'))
                                                                            <i class="lni lni-empty-file text-danger fs-3"></i>
                                                                        @else
                                                                            <i class="lni lni-files text-secondary fs-3"></i>
                                                                        @endif
                                                                    </div>

                                                                    <div class="flex-grow-1 overflow-hidden">
                                                                        <p class="mb-0 small fw-bold text-truncate" title="{{ $file->caption }}">
                                                                            {{ $file->caption }}
                                                                        </p>
                                                                        <small class="text-muted" style="font-size: 10px;">
                                                                            {{ strtoupper(pathinfo($file->file_name, PATHINFO_EXTENSION)) }}
                                                                        </small>
                                                                    </div>

                                                                    <a href="{{ asset('storage/uploads/persil/' . $file->file_name) }}"
                                                                        target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                                                                        <i class="lni lni-eye"></i>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="text-center py-4 text-muted border border-dashed rounded">
                                                            <i class="lni lni-cross-circle fs-2 opacity-50 mb-2"></i>
                                                            <p class="small mb-0">Tidak ada lampiran.</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END MODAL --}}

                    @empty
                        <div class="col-12 text-center mt-5">
                            <div class="p-5 bg-light rounded shadow-sm border border-dashed">
                                <i class="lni lni-folder text-muted opacity-25" style="font-size: 60px;"></i>
                                <h5 class="mt-3 text-muted">Belum ada data persil.</h5>
                                <p class="text-muted small">Silakan tambahkan data baru melalui tombol di atas.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="">
                    {{ $dataPersil->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

    {{-- Tambahan CSS agar hover list file lebih enak --}}
    <style>
        .hover-shadow:hover {
            background-color: #f8f9fa !important;
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
            border-color: #007bff !important;
            cursor: pointer;
        }
    </style>
@endsection
