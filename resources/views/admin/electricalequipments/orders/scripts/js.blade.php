<x-core-input type="hidden" name="route_create_contract_payment" :value="route('admin.contract_payment.create')" />
<script>
function loadShortNameCT(elm)
{
    $('.ct-short-name').text($('option:selected', elm).data('short-name'));
}

loadShortNameCT($('select[name="electricalequipment[customer_type_id]"]'));
$('.create-ct').click(function() {
    $.ajax({
        type: "get",
        url: $('input[name="route_create_contract_payment"]').val(),
        success: function (response) {
            $('#cotntractPayment').append(response);

            addFilePondForContractPayment();
        },
        error: function(response) {
            handleAjaxError(response);
        }
    });
});


function addFilePondForContractPayment()
{
    $('#cotntractPayment .list-group-item:last-child .filepond').each(function() {

        console.log(this);
        var filepond = FilePond.create(this);

        filepond.setOptions(filePondConfig);
        console.log(filepond);
    })
}

$(document).on('click', '.delete-item-ct', function () {
    $(this).parents('.item-ct').remove();
});

$(document).ready(function(e) {
    $("#formContractStore").submit(function(e) {

        var total = parseInt($('input[name="contract[total_amount]"]').val().replace(/,/g, ''));

        if(deposit > total)
        {
            e.preventDefault();

            msgError(window.__trans('Tiền đặt cọc phải nhỏ hơn tiền tổng hợp đồng'));
            return;
        }

        var cp = $("#cotntractPayment").find('.input-format-number');

        if(cp.length > 0)
        {
            var subTotal = 0;

            $.each(cp, function (index, elm) {
                subTotal += parseInt($(elm).val().replace(/,/g, ''));
            });

            if(subTotal > total)
            {
                e.preventDefault();

                msgError(window.__trans('Tổng tiền đợt thanh toán phải nhỏ hơn tiền tổng hợp đồng'));
            }
        }

    });
})
</script>
