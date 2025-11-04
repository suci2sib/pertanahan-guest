@extends('layouts.guest.app')

@section('content')
    <!-- Daftar Warga -->
    <br><br>
    <section id="warga" class="section team-area">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn" data-wow-delay=".2s">Data Warga Desa</h3>
                <h2 class="wow fadeInUp" data-wow-delay=".4s">Daftar Penduduk Terdaftar</h2>
                <p class="wow fadeInUp" data-wow-delay=".6s">
                    Berikut adalah daftar warga yang telah terdata dalam sistem pertanahan desa.
                </p>
            </div>

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    <i class="lni lni-checkmark-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Tombol tambah warga --}}
            <div class="text-center mb-4">
                <a href="{{ route('warga.create') }}" class="btn btn-primary">
                    <i class="lni lni-plus"></i> Tambah Warga
                </a>
            </div>

            <div class="row justify-content-center">
                @forelse ($dataWarga as $item)
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="single-team wow fadeInUp shadow-sm" data-wow-delay=".2s"
                            style="border-radius: 15px; overflow: hidden;">
                            <div class="p-4 bg-white text-center">
                                <div class="mb-3">
                                    <i class="lni lni-user" style="font-size: 50px; color: #007bff;"></i>
                                </div>
                                <h4 class="mb-1">{{ $item->nama }}</h4>
                                <p class="text-muted mb-2">{{ $item->no_ktp }}</p>

                                <ul class="list-unstyled mb-3">
                                    <li><i class="lni lni-genderless"></i> {{ $item->jenis_kelamin }}</li>
                                    @if ($item->agama)
                                        <li><i class="lni lni-sun"></i> {{ $item->agama }}</li>
                                    @endif
                                    @if ($item->pekerjaan)
                                        <li><i class="lni lni-briefcase"></i> {{ $item->pekerjaan }}</li>
                                    @endif
                                    @if ($item->telp)
                                        <li><i class="lni lni-phone"></i> {{ $item->telp }}</li>
                                    @endif
                                    @if ($item->email)
                                        <li><i class="lni lni-envelope"></i> {{ $item->email }}</li>
                                    @endif
                                </ul>

                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('warga.edit', $item->warga_id) }}"
                                        class="btn btn-warning btn-sm me-2">
                                        <i class="lni lni-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
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
                        <p class="text-muted">Belum ada data warga yang terdaftar.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}

        </div>
    </section>
@endsection
