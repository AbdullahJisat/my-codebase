<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Codebase" name="abdullahjisat" />

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>{{ getSiteName() }}</title>

    @include('partials.links')
</head>

<body data-sidebar="dark">
    <div id="preloader" style="display: none;">
        <div id="status" style="display: none;">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <div id="layout-wrapper">
        @include('admin.partials.header')
        @include('admin.partials.sidebar')
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    {{-- @include('partials.page_title') --}}
                    {{-- @include('partials.content') --}}
                    @yield('content')
                    {{-- @include('partials.modal') --}}
                    @yield('modal')
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
    @include('partials.scripts')
</body>

</html>