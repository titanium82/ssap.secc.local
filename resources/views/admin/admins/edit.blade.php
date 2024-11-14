@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form :action="route('admin.admin.update')" type="put" :validate="true">
                <x-core-input type="hidden" name="id" :value="$admin->id" />
                <div class="row justify-content-center">
                    @include('admin.admins.forms.edit-left')
                    @include('admin.admins.forms.edit-right')
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