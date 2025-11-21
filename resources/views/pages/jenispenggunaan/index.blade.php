@extends('layouts.guest.app')

@section('content')
    <!-- Daftar Jenis Penggunaan -->
    <br><br>
    <section id="jenispenggunaan" class="section team-area">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Data Jenis Penggunaan Tanah</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Daftar Klasifikasi Penggunaan Tanah</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Berikut adalah daftar jenis penggunaan tanah yang terdata di sistem desa.
                </p>
            </div>
            <div class="table-responsive">
                <form method="GET" action="{{ route('jenispenggunaan.index') }}" class="mb-3">
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

            {{-- Tombol tambah jenis penggunaan --}}
            <div class="text-center mb-4">
                <a href="{{ route('jenispenggunaan.create') }}" class="btn btn-primary">
                    <i class="lni lni-plus"></i> Tambah Jenis Penggunaan
                </a>
            </div>

            <div class="row justify-content-center">
                @forelse ($dataJenisPenggunaan as $item)
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="single-team wow fadeInUp shadow-sm" data-wow-delay=".2s"
                            style="border-radius: 15px; overflow: hidden;">
                            <div class="p-4 bg-white text-center">
                                <div class="mb-3">
                                    <i class="lni lni-map" style="font-size: 50px; color: #28a745;"></i>
                                </div>
                                <h4 class="mb-1">{{ $item->nama_penggunaan }}</h4>
                                <p class="text-muted mb-3">{{ $item->keterangan }}</p>

                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('jenispenggunaan.edit', $item->jenis_id) }}"
                                        class="btn btn-warning btn-sm me-2">
                                        <i class="lni lni-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('jenispenggunaan.destroy', $item->jenis_id) }}" method="POST"
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
                        <p class="text-muted">Belum ada data jenis penggunaan yang terdaftar.</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-3">
                    {{ $dataJenisPenggunaan->links('pagination::simple-bootstrap-5') }}
                </div>
        </div>
    </section>
@endsection
