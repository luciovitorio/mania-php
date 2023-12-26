<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta
        http-equiv="X-UA-Compatible"
        content="ie=edge"/>
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- CSS files -->
    <link
        href="{{ asset('assets/css/tabler.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/tabler-flags.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/toastr.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/tabler-payments.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/tabler-vendors.min.css') }}"
        rel="stylesheet"/>
    <link
        href="{{ asset('assets/css/demo.min.css') }}"
        rel="stylesheet"/>
    <link
        href="@yield('css')"
        rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
<body>
<script src="{{ asset('assets/js/demo-theme.min.js') }}"></script>
<div class="page">
    <!-- Sidebar -->
    @include('layout-dashboard.aside')
    <!-- Navbar -->
    @include('layout-dashboard.navbar')
    <div class="page-wrapper">
        <!-- Page header -->
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    @yield('content')
                </div>
            </div>
        </div>
        {{--        Footer--}}
        @include('layout-dashboard.footer')
    </div>
</div>
<!-- Tabler Core -->
<script
    src="{{ asset('assets/js/tabler.min.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/demo.min.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/jquery.min.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/toastr.min.js') }}"
    defer></script>
<script
    src="{{ asset('assets/js/jquery.mask.js') }}"
    defer></script>
@yield('js')
</body>
</html>
