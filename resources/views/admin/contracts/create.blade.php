@extends('admin.layouts.master')

@push('libs-css')
<!-- Filepond stylesheet -->
<link href="{{ asset('public/core/libs/filepond/dist/filepond.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/core/libs/filepond/plugins/image-preview/dist/filepond-plugin-image-preview.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/core/libs/filepond/plugins/file-poster/filepond-plugin-file-poster.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-core-form id="formContractStore" :action="route('admin.contract.store')" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('admin.contracts.forms.create-left')
                    @include('admin.contracts.forms.create-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-core-form>
        </div>
    </div>
@endsection

@push('libs-js')
@include('ckfinder::setup')

<!-- include FilePond library -->
<script src="{{ asset('public/core/libs/filepond/dist/filepond.min.js') }}"></script>

<!-- include FilePond plugins -->
<script src="{{ asset('public/core/libs/filepond/plugins/image-preview/dist/filepond-plugin-image-preview.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/file-validate-size/dist/filepond-plugin-file-validate-size.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/file-validate-type/dist/filepond-plugin-file-validate-type.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/image-resize/dist/filepond-plugin-image-resize.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/file-encode/dist/filepond-plugin-file-encode.min.js') }}"></script>
<script src="{{ asset('public/core/libs/filepond/plugins/file-poster/filepond-plugin-file-poster.min.js') }}"></script>

<!-- include FilePond jQuery adapter -->
<script src="{{ asset('public/core/libs/jquery-filepond/filepond.jquery.js') }}"></script>

@endpush

@push('js')
<script src="{{ asset('public/core/assets/js/filepond.js') }}"></script>

@include('admin.contracts.scripts.js')
<script>
    function cleanNumberString(value) {
        var cleanedValue = value.replace(/[^0-9.-]+/g, "");     // Remove commas or other formatting characters
        return parseFloat(cleanedValue) || 0;                   // return value.replace(/[^0-9.-]+/g, "");
    }

    var totalNumber = 0;
    var subtotalNumber = 0;
    $(document).on('change', '#total .input-format-number', function(){
        totalNumber = 0;
        $('#total .input-format-number').each(function(i,e){
            var total = $(e).val()|| 0;
            totalNumber = cleanNumberString(total);
            console.log("Total Number:", totalNumber);
        });
    })
    //Lấy dữ liệu Giá trị phụ lục
    $(document).on('change', '#subtotal .input-format-number', function(){
        subtotalNumber = 0;
        $('#subtotal .input-format-number').each(function(i,e){
            var subtotal = $(e).val()|| 0;
            subtotalNumber = cleanNumberString(subtotal);
        });
        if(subtotalNumber < totalNumber){
            $('#error_total').text('* Tổng giá trị phụ lục phải lớn hơn Tổng giá trị');
            $('#error_total').show();
        }
        else{
            $('#error_total').hide();
        }
    })

    $(document).on('change', '#cotntractPayment .input-format-number', function() {
        var totalAmount = 0;
        $('#cotntractPayment .input-format-number').each(function(i, e){
            var amount = $(e).val()|| 0;
            var Amount = cleanNumberString(amount);
            totalAmount += Amount;

            var totalAmountString = totalAmount.toLocaleString();
            console.log(typeof totalAmountString);
            console.log(subtotal);
            $('#total_amount .input-format-number').text(totalAmountString);
            //kiểm tra totalAmount
            if(totalAmount >subtotalNumber && totalNumber==0){
                    $('#error_message').text('Số tiền vượt quá tổng giá trị phụ lục');
                    $('#error_message').show();
                    console.log("Sub total cuối cùng",subtotalNumber);
            }
            else if(totalAmount > totalNumber && subtotalNumber ==0){
                    $('#error_message').text('Số tiền vượt quá tổng giá trị');
                    $('#error_message').show();
                    console.log("total cuối cùng",subtotalNumber);
            }
            else if(totalAmount >subtotalNumber && subtotalNumber>totalNumber){
                    $('#error_message').text('Số tiền vượt quá tổng giá trị phụ lục');
                    $('#error_message').show();
                    console.log("Sub total cuối cùng",subtotalNumber);
            }
            else{
                $('#error_message').hide();
            }
        });
    })
</script>
@endpush
