
var initialAjaxFormLibrary = {
    target: $('.ajax-modal-form'), // form hiện tại
    modalTarget: $('.modal'), // modal hiện tại
    method: 'GET', // phương thức call
    url: '', // url call lên server
    loadDatatable: false, // true: sẽ load lại datatable
    // Lấy dữ liệu từ form
    getData: function() {
        return this.target.serialize();
    },
    //set modal form khi người dùng thao tác
    setModalTarger: function() {
        this.modalTarget = this.target.parents('.modal');
    },
    //get modal form khi người dùng thao tác
    getModalTarger: function() {
        this.setModalTarger();
        return this.modalTarget;
    },
    setMethod: function() {
        if(this.target.attr('method').toUpperCase() == 'POST')
        {
            this.method = 'POST';

            if(this.target.find('input[name="_method"]').length == 1)
            {
                this.method = this.target.find('input[name="_method"]').val();
            }
        }
        this.method = this.method.toUpperCase();
    },
    getMethod: function() {
        this.setMethod();
        return this.method;
    },
    setUrl: function() {
        this.url = this.target.attr('action');
    },
    getUrl: function() {
        this.setUrl();
        return this.url;
    },
    setLoadDatatable: function() {
        if(this.target.data('load-dt') && this.target.data('load-dt') == true)
        {
            this.loadDatatable = true;
        }else {
            this.loadDatatable = false;
        }

    },
    getLoadDatatable: function() {
        this.setLoadDatatable();
        return this.loadDatatable;
    },
    // gọi trước khi send
    beforeRequest: function() {

        this.target.parsley();
    },
    //gọi trước khi thành công response kết quả
    beforeSuccess: function(response) {},
    //gọi sau khi thành công response kết quả
    afterSuccess: function(response) {},
    
    //gọi khi thành công response kết quả
    success: function(response) {

        this.beforeSuccess(response);
        
        if(response.status == 400)
        {
            msgError(response.msg);        
        }else {
            msgSuccess(response.msg);
        }
        
        ModalLibrary.close();

        if(this.getLoadDatatable())
        {
            this.handleLoadDatatable();
        }

        this.afterSuccess(response);
    },

    beforeComplete: function(response) {},

    afterComplete: function(response) {},

    complete: function(response) {

        this.beforeComplete(response);

        removeOverlayLoading(this.target);

        this.afterComplete(response);
    },
    handleLoadDatatable: function(tableId = null) {

        var typeDraw = false;

        if(this.getMethod() == 'POST')
        {
            typeDraw = true;
        }

        if(tableId == null)
        {
            tableId = this.target.data('table-id');
        }
        
        var dt = window.LaravelDataTables[tableId];
        
        if(typeDraw)
        {
            dt.search('');
            dt.columns().search('');
        }

        dt.draw(typeDraw);
    },
    ajaxRequest: function() {
        
        this.beforeRequest();

        AjaxLibrary.ajaxRequest(
            this.getUrl(), 
            this.getMethod(), 
            this.getData(), 
            this.success.bind(AjaxFormLibrary), 
            handleAjaxError, 
            this.complete.bind(AjaxFormLibrary)
        );
    }
};

var AjaxFormLibrary = {...initialAjaxFormLibrary};

function resetAjaxFormLibrary() {
    AjaxFormLibrary = {...initialAjaxFormLibrary};
}

var AjaxLibrary = {
    // Hàm tiện ích chung để thực hiện các yêu cầu AJAX
    ajaxRequest: function(url, method, data, successCallback, errorCallback, completeCallback) {
        $.ajax({
            url: url,
            type: method,
            data: data,
            // contentType: method === 'GET' ? 'application/x-www-form-urlencoded; charset=UTF-8' : 'application/json; charset=utf-8',
            success: function(response) {
                if (successCallback) {
                    successCallback(response);
                }
            },
            error: function(response) {
                if (errorCallback) {
                    errorCallback(response);
                }else {
                    handleAjaxError(response);
                }
            },
            complete: function(response) {
                if(completeCallback){
                    completeCallback(response)
                }
            }
        });
    },
    // Hàm gửi yêu cầu GET
    get: function(url, params, successCallback, errorCallback, completeCallback) {
        this.ajaxRequest(url, 'GET', params, successCallback, errorCallback, completeCallback);
    },

    // Hàm gửi yêu cầu POST
    post: function(url, params, successCallback, errorCallback, completeCallback) {
        this.ajaxRequest(url, 'POST', params, successCallback, errorCallback, completeCallback);
    },

    // Hàm gửi yêu cầu PUT
    put: function(url, params, successCallback, errorCallback, completeCallback) {
        this.ajaxRequest(url, 'PUT', params, successCallback, errorCallback, completeCallback);
    },

    // Hàm gửi yêu cầu DELETE
    delete: function(url, params, successCallback, errorCallback, completeCallback) {
        this.ajaxRequest(url, 'DELETE', params, successCallback, errorCallback, completeCallback);
    }
};

$(document).on('submit', '.ajax-modal-form', function(e) {
    e.preventDefault();
    resetAjaxFormLibrary();
    AjaxFormLibrary.target = $(this);
    AjaxFormLibrary.ajaxRequest();
})