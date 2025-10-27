<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Pertanahan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Start CSS -->
    @include('layouts.admin.user.css')
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    @include('layouts.admin.user.header')
    <!-- Navbar End -->

    <!-- Main Content Start -->
    @yield('content')
    <!-- Main Content End -->

    <!-- Footer Start -->
    @include('layouts.admin.user.footer')
    <!-- Footer End -->

    <!-- JavaScript -->
    @include('layouts.admin.user.js')

</body>

</html>
