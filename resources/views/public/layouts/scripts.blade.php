<script src="{{ asset('public/core/templates/tabler/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('public/core/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/core/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('public/core/libs/parsley/parsley.min.js') }}"></script>

@stack('libs-js')
<script type="module" src="{{ asset('public/core/assets/js/i18n.js') }}"></script>
<script src="{{ asset('public/core/assets/js/init.js') }}"></script>
@stack('js')