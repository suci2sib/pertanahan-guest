<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Bina Desa - Sistem Informasi Pertanahan</title>
    <meta name="description" content="Sistem Informasi Pertanahan Desa" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @include('layouts.guest.css')
</head>

<body>
    <!-- Header -->
    @include('layouts.guest.header')
    <!-- End Header -->
    <!-- Main Content -->
    @yield('content')
    <!-- Footer -->
    @include('layouts.guest.footer')
</body>
    <!-- ========================= JS ========================= -->
    @include('layouts.guest.js')

</html>
