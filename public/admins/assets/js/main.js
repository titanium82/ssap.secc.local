$(document).ready(function () {

    var currentLocation = window.location.href; // Lấy đường dẫn của trang hiện tại
    // Duyệt qua từng phần tử li trong menu
    $("#sidebar-menu li").each(function() {
        var menuItem = $(this);
        var menuLink = menuItem.find("a");
        $(menuLink).each(function() {
            linkLocation = $(this).attr('href');
            // So sánh đường dẫn của menu item với đường dẫn của trang hiện tại
            if (linkLocation === currentLocation) {
                $(this).parents('.nav-item').addClass('active');
                $(this).addClass('active');
                menuItem.find(".dropdown-toggle.nav-link, .dropdown-menu").addClass("show");
            }
        });
    });

    if($("#blockSubmit").length){
        $(window).scroll(function() {

            var scrollTop = $(window).scrollTop();
    
            if (scrollTop >= $("#blockSubmit").offset().top + $("#blockSubmit").height()) {
                $("#blockSubmitFixed").css('display', 'block');
            }else{
                $("#blockSubmitFixed").css('display', 'none');
            }
        });
    }

});

function addTagifyBasic(elm = '.tagify-basic')
{
    var input = document.querySelector(elm);

    new Tagify(input);
}

function removeOverlayLoading(elm){
    elm = $(elm);
    elm.find('#overlayLoading').remove();
    elm.find("button[type='submit']").css("opacity", "1");
    elm.find("button[type='submit'] .spinner-grow").remove();
}

function addOverlayLoading(elm){
    elm = $(elm);
    elm.prepend('<div id="overlayLoading" style="position: absolute;width: 100%;height: 100%;background: #ffffff91;z-index: 10;"></div>')
    elm.find("button[type='submit']").css("opacity", "0.5");
    elm.find("button[type='submit']").prepend('<span class="spinner-grow spinner-grow-sm"></span>');
}

$(document).on('keyup', '.input-format-number', function(e) {
    var inputValue = $(this).val();

    $(this).val(input_format_number(inputValue));
});

$(document).on('submit', 'form.ajax-modal-form, form.block-double-click', function(e) {
    addOverlayLoading(this);
});

//thông báo lỗi khi chưa chọn bản ghi để xử lý
$(document).on('submit', '#formMultiple', function(e) {

	if($('.check-list:checked').length == 0){
		e.preventDefault();
        $.toast({
            heading: window.__trans('notìy'),
            text: window.__trans('pleaseChooseRecord'),
            position: 'top-right',
            icon: 'warning'
        });
        endAjax($(this), window.__trans('apply'));
		return;
    }
	if(!confirm('Bạn có muốn thực hiện?')){
		e.preventDefault();
		endAjax($(this), window.__trans('apply'));
		return;
	}
})

//check all
$(document).on('click', '.check-all', function(e) {
    $(".check-list").prop('checked', $(this).prop('checked'));
    if($(this).prop('checked') == true){
        $('.check-all').prop('checked', true);
        $(".select-action-multiple").removeAttr('style');
    }
    else{
        $('.check-all').prop('checked', false);
        $(".select-action-multiple").css('display', 'none');
    }
});

$(document).on('click', '.check-list', function(e) {
    if($(this).prop('checked') == false){
        $('.check-all').prop('checked', false);
    }
    if($('.check-list:checked').length == $('.check-list').length){
        $('.check-all').prop('checked', true);
    }
    if($('.check-list:checked').length > 0){
        $(".select-action-multiple").removeAttr('style');
    }else{
        $(".select-action-multiple").css('display', 'none');
    }
});