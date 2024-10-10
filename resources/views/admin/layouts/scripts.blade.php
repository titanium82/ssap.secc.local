<script src="{{ asset('public/core/templates/tabler/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('public/core/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/core/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('public/core/libs/parsley/parsley.min.js') }}"></script>

{{-- datatable latest --}}
{{-- <script src="{{ asset('public/core/libs/datatables/datatables.min.js') }}"></script>

<script src="{{ asset('public/core/libs/datatables/plugins/bootstrap5/js/dataTables.bootstrap5.js') }}"></script>

<script src="{{ asset('public/core/libs/datatables/plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/core/libs/datatables/plugins/buttons/js/buttons.bootstrap5.min.js') }}"></script>

<script src="{{ asset('public/core/libs/datatables/plugins/responsives/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/core/libs/datatables/plugins/responsives/js/responsive.bootstrap5.js') }}"></script> --}}

{{-- datatable oldlest --}}
<script src="{{ asset('/public/core/libs/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('/public/core/libs/datatables/plugins/bs5/js/dataTables.bootstrap5.min.js') }}"></script>

<script src="{{ asset('/public/core/libs/datatables/plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/public/core/libs/datatables/plugins/buttons/js/buttons.bootstrap5.min.js') }}"></script>

<script src="{{ asset('/public/core/libs/datatables/plugins/responsive/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/core/libs/datatables/plugins/responsive/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('/public/core/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('/public/core/libs/select2/js/i18n/'.app()->getLocale().'.js') }}"></script>


@stack('libs-js')
<script type="module" src="{{ asset('public/core/assets/js/i18n.js') }}"></script>
<script src="{{ asset('public/core/assets/js/init.js') }}"></script>
<script src="{{ asset('public/core/assets/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admins/assets/js/datatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admins/assets/js/ck-finder-editor.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/admins/assets/js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/core/assets/js/modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/core/assets/js/modal-form.js') }}"></script>

@stack('js')