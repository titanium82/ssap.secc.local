function addSelect2(elm = '.select2-bs5'){
    if($(elm).length){
        $(elm).select2({
            placeholder: window.__trans('choose'),
            language: "vi",
            theme: 'bootstrap-5',
            allowClear: true
        });
    }
}

function select2LoadDataMany(target = '.select2-bs5-ajax-many'){
    var elm = $(target);
    if(elm.length > 0){
        elm.each(function () { 
            select2LoadData('', this);
        });
    }
}

function select2LoadData(url = '', target = '.select2-bs5-ajax'){
    if($(target).length > 0){
        if(!url){
            url = $(target).data('url');
        }

        var dropdownParent = $(document.body);

        if ($(this).parents('.modal').length !== 0)
        {
            dropdownParent = $(this).parents('.modal').find('.modal-body');
        }

        $(target).select2({
            placeholder: window.__trans('choose'),
            language: "vi",
            theme: 'bootstrap-5',
            dropdownParent: dropdownParent,
            allowClear: true,
            ajax: {
                delay: 250,  // wait 250 milliseconds before triggering the request
                url: url,
                dataType: 'json',
                processResults: function (data, params) {
                    return data;
                }
            }
        });
    }
}