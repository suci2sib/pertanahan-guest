@extends('layouts.guest.app')

@section('content')
    <br><br>
    <section id="jenispenggunaan" class="section team-area">
        <div class="container">
            <div class="section-title text-center">
                <h3 class="wow zoomIn">Data Jenis Penggunaan Tanah</h3>
                <h2 class="wow fadeInUp">Klasifikasi Penggunaan</h2>
            </div>
            
            <div class="table-responsive">
                <form method="GET" action="{{ route('jenispenggunaan.index') }}" class="mb-3">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="input-group shadow-sm">
                                <input type="text" name="search" class="form-control"
                                    value="{{ request('search') }}" placeholder="Cari penggunaan...">
                                <button type="submit" class="btn btn-primary"><i class="lni lni-search-alt"></i></button>
                                @if (request('search'))
                                    <a href="{{ route('jenispenggunaan.index') }}" class="btn btn-secondary">Reset</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

                @if (session('success')) <div class="alert alert-success text-center shadow-sm">{{ session('success') }}</div> @endif
                @if (session('error')) <div class="alert alert-danger text-center shadow-sm">{{ session('error') }}</div> @endif

                <div class="text-center mb-4">
                    <a href="{{ route('jenispenggunaan.create') }}" class="btn btn-primary rounded-pill px-4 shadow"><i class="lni lni-plus"></i> Tambah Data</a>
                </div>

                <div class="row justify-content-center">
                    @forelse ($dataJenisPenggunaan as $item)
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="single-team shadow-sm bg-white d-flex flex-column h-100" style="border-radius: 15px; border: 1px solid #eee;">
                                <div class="p-4 text-center flex-grow-1">
                                    <div class="mb-4">
                                        <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle" style="width: 80px; height: 80px;">
                                            <i class="lni lni-sprout text-success" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                    <h4 class="mb-2 text-dark">{{ $item->nama_penggunaan }}</h4>
                                    <p class="text-muted px-3">{{ $item->keterangan }}</p>
                                </div>
                                
                                {{-- PERBAIKAN: Admin & Super Admin Boleh Edit --}}
                                @if(Auth::check() && in_array(Auth::user()->role, ['Admin', 'Super Admin']))
                                    <div class="card-footer bg-white border-top-0 p-3 pt-0 mt-auto">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('jenispenggunaan.edit', $item->jenis_id) }}" class="btn btn-warning btn-sm rounded-pill px-4 text-white shadow-sm">
                                                <i class="lni lni-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('jenispenggunaan.destroy', $item->jenis_id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4 shadow-sm">
                                                    <i class="lni lni-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center mt-4"><p class="text-muted">Tidak ada data.</p></div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $dataJenisPenggunaan->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection