<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles
@stack("styles")
@stack("styles")

<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/assets/chart.js') }}"></script>
    <script src="{{ asset('js/assets/jquery-3.5.1.min.js') }}"></script>

    <link rel="stylesheet" type="text/css"
          href="{{ asset('css/toastr.min.css') }}">

    <script src="{{ asset('js/assets/toastr.min.js') }}"></script>

</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @livewire('navigation-dropdown')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    <main>
        {{ $slot ?? null }}
    </main>
</div>

@stack('modals')

@livewireScripts
@stack("scripts")
<script src="{{ asset('js/assets/sweetalert.min.js') }}"></script>
<script type="module" src="{{ asset('js/assets/ionicons.esm.js') }}"></script>
<script nomodule="" src="{{ asset('js/assets/ionicons.min.js') }}"></script>

<script>
    window.addEventListener('alert', event => {
        Swal.fire({
            position: 'center',
            icon: event.detail.type,
            title: event.detail.message,
            showConfirmButton: true,
        });
    })
</script>

<script>
    @if(session()->has('message'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(session()->has('error'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(session()->has('info'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(session()->has('warning'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
</body>
</html>
