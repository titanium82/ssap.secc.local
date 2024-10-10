@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.admin.store')" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('admin.admins.forms.create-left')
                    @include('admin.admins.forms.create-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection

@push('js')
<script>
$(document).ready(function(){
    $('input[name="admin[is_superadmin]"]').change(function(e) {
        if(this.checked) {
           $("#rolePermission").css('display', 'none');
           $('input[name="roles[]"]').prop('checked', false);
           $('input[name="permissions[]"]').prop('checked', false);
        }else{
            $("#rolePermission").css('display', 'block');
        }
    })
})
</script>
@endpush
