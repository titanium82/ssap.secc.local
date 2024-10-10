<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('admin.layouts.head')
</head>

<body class="layout-fluid">
    <div class="page">
        <x-admin-sidebar-left />
        @include('admin.layouts.sidebar-top')
        <div class="page-wrapper">
            @section('breadcrums')
                @include('admin.layouts.partials.breadcrums')
            @show
            @yield('content')

            @include('admin.layouts.footer')

            @include('admin.layouts.modal.modal-logout')

            @include('admin.layouts.modal.modal-delete')

            @include('admin.layouts.modal.modal-ajax-delete')
            
        </div>
    </div>
    @include('admin.layouts.scripts')
    <x-core-alert />
</body>

</html>
