{{-- Flash Messages --}}
@if (session('success') || session('error') || $errors->any())
    <div class="mt-3">
        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Pesan error umum --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Pesan error dari validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
@endif
