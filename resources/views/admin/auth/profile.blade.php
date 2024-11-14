@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <x-core-form :action="route('admin.profile.update')" type="put" enctype="multipart/form-data" :validate="true">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-6 col-md-3 text-center">
                                    <img id="avatar" class="img-thumbnail avatar avatar-xl mb-3 rounded input-image" data-input-target="input[name=avatar]" src="{{ asset($auth->avatar) }}" alt="">
                                    <x-core-input type="file" class="d-none" name="avatar" data-preview="#avatar" onchange="imagePreview(this)"/>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary input-image" data-input-target="input[name=avatar]">@lang('Change')</button>
                                    </div>
                                </div>
                            </div>
                            <!-- fullname -->
                            <div class="mb-3">
                                <label class="form-label">@lang('fullname'):</label>
                                <x-core-input name="fullname" :value="$auth->fullname" :required="true" placeholder="{{ __('fullname') }}"/>
                            </div>
                            <!-- phone -->
                            <div class="mb-3">
                                <label class="form-label">@lang('phone'):</label>
                                <x-core-input-phone name="phone" :value="$auth->phone" :required="true" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('birthday'):</label>
                                <x-core-input type="date" name="birthday" :value="$auth->birthday" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">@lang('Gender'):</label>
                                <x-core-select name="gender" :required="true">
                                    @foreach ($gender as $key => $value)
                                        <x-core-select-option :option="$auth->gender?->value" :value="$key" :title="$value" />
                                    @endforeach
                                </x-core-select>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-center">
                                <button type="submit" class="btn btn-primary">@lang('Update')</button>
                            </div>
                        </div>
                    </div>
                    </x-core-form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    
    $(".input-image").click(function(e){
        $($(this).data('input-target')).click();
    });

    function imagePreview(input_file){
    file = input_file.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
            $($(input_file).data('preview'))
                .attr("src", event.target.result);
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
