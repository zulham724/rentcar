<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}"
    data-base-url="{{ url('/') }}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | Sneat - HTML Laravel Free Admin Template </title>
    <meta name="description"
        content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta name="keywords"
        content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Include Styles -->
    @include('layouts/sections/styles')

    <!-- Include Scripts for customizer, helper, analytics, config -->
    @include('layouts/sections/scriptsIncludes')
</head>

<body>
    <!-- Layout Content -->
    @yield('layoutContent')
    <!--/ Layout Content -->

    {{-- remove while creating package --}}
    <div class="buy-now">
        <a href="{{ config('variables.productPage') }}" target="_blank" class="btn btn-danger btn-buy-now">Upgrade To
            Pro</a>
    </div>
    {{-- remove while creating package end --}}

    <!-- Include Scripts -->
    @include('layouts/sections/scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js"
        integrity="sha512-OmBbzhZ6lgh87tQFDVBHtwfi6MS9raGmNvUNTjDIBb/cgv707v9OuBVpsN6tVVTLOehRFns+o14Nd0/If0lE/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function notifToast(type, message) {
            if (type == 'success') {
                iziToast.success({
                    title: 'Success',
                    message: message,
                    position: 'topRight'
                })
            } else if (type == 'error') {
                iziToast.error({
                    title: 'Failed',
                    message: message,
                    position: 'topRight'
                })
            }
        }

        @if (Session::has('success_msg'))
            notifToast('success', "{{ Session::get('success_msg') }}")
        @endif

        @if (Session::has('error_msg'))
            notifToast('error', "{{ Session::get('error_msg') }}")
        @endif
    </script>
    @yield('script')

</body>

</html>
