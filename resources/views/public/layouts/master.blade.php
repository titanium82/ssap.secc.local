<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('public.layouts.head')
</head>

<body>
    <div class="page">
        <div class="page-wrapper">

            @yield('content')

            @include('public.layouts.footer')

        </div>
    </div>
    @include('public.layouts.scripts')
    {{-- <x-alert /> --}}
</body>

</html>
