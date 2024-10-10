<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url-home" content="{{ url('/') }}">
<title>@yield('title', config('app.name'))</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('core.images.favicon')) }}" />
<!-- CSS files -->
<link href="{{ asset('/public/core/templates/tabler/css/tabler.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('/public/core/templates/tabler/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('/public/core/templates/tabler/icons/dist/tabler-icons.min.css') }}" rel="stylesheet"type="text/css">
<link href="{{ asset('/public/core/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"type="text/css">
<link href="{{ asset('/public/core/libs/parsley/style.css') }}" rel="stylesheet">

<style>
    @import url('https://rsms.me/inter/inter.css');
    :root {
    --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }
    body {
    font-feature-settings: "cv03", "cv04", "cv11";
    }
</style>

<link href="{{ asset('public/core/assets/css/init.css') }}" rel="stylesheet">
@stack('libs-css')
@stack('css')