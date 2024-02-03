<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-sidebar="light"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

@php
    $result = \App\Helper\AplicationHelper::getAplication();
@endphp

<head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var htmlElement = document.documentElement;
            var storedSidebar = localStorage.getItem('data-bs-theme');

            // Update data-sidebar if a value is found in local storage
            if (storedSidebar == 'dark') {
                htmlElement.setAttribute('data-sidebar', 'light');
                htmlElement.setAttribute('data-bs-theme', 'light');
            } else {
                htmlElement.setAttribute('data-sidebar', 'dark');
                htmlElement.setAttribute('data-bs-theme', 'dark');
            }
        });
    </script>

    <meta charset="utf-8" />
    <title>@yield('title')|{{ $result->title ?? 'Tata Usaha' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="base-url" content="{{ env('APP_URL') }}">
    {{-- csrf --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    @if (!empty($result->favicon))
        <link rel="shortcut icon" href="{{ URL::asset('storage/' . $result->favicon) }}">
    @else
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    @endif
    @include('layouts.head-css')
</head>

@section('body')
    @include('layouts.body')
@show
<!-- Begin page -->
<div id="layout-wrapper">
    @include('layouts.topbar')
    @include('layouts.sidebar', ['aplication' => $result])
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('layouts.footer', ['result' => $result])
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->



<!-- JAVASCRIPT -->
@include('layouts.vendor-scripts')
</body>

</html>
