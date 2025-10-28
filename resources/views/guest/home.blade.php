@extends('layouts.guest.app')

@section('content')
    <section class="main-content">
        <div class="container-fluid py-5" style="background: linear-gradient(135deg, #f8d7e0, #fbe9d7);">
            <div class="container py-5">
                <div class="text-center mb-5 wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-5 fw-bold text-danger">Data Persil Desa</h1>
                    <p class="text-muted">Informasi singkat mengenai lahan dan kepemilikan warga desa.</p>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach ($dataPersil as $item)
                        <div class="col-md-1 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="card-persil bg-white rounded-4 shadow-sm border-0 overflow-hidden">

                                <!-- Header -->
                                <div class="card-header py-4 text-center text-white"
                                    style="background: linear-gradient(90deg, #ff9db6, #ffd6e0);">
                                    <h4 class="fw-bold mb-0">Kode Persil: {{ $item->kode_persil }}</h4>
                                </div>

                                <!-- Body -->
                                <div class="card-body p-4">
                                    <div class="row g-3 align-items-center">

                                        <div class="col-sm-6">
                                            <p class="mb-1 text-muted small">Pemilik (ID Warga)</p>
                                            <h6 class="fw-semibold">{{ $item->pemilik_warga_id }}</h6>
                                        </div>

                                        <div class="col-sm-6">
                                            <p class="mb-1 text-muted small">Luas Lahan</p>
                                            <h6 class="fw-semibold">{{ $item->luas_m2 }}</h6>
                                        </div>

                                        <div class="col-sm-6">
                                            <p class="mb-1 text-muted small">Penggunaan</p>
                                            <h6 class="fw-semibold">{{ $item->penggunaan }}</h6>
                                        </div>

                                        <div class="col-12">
                                            <p class="mb-1 text-muted small">Alamat Lahan</p>
                                            <h6 class="fw-semibold">{{ $item->alamat_lahan }}</h6>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <div>
                                                <p class="mb-1 text-muted small">RT</p>
                                                <h6 class="fw-semibold">{{ $item->rt }}</h6>
                                            </div>
                                            <div>
                                                <p class="mb-1 text-muted small">RW</p>
                                                <h6 class="fw-semibold">{{ $item->rw }}</h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- End Body -->

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
