function selectImageCKFinder( preview, in_value, type ) {
	CKFinder.popup( {
		chooseFiles: true,
		width: 800,
		height: 600,
		onInit: function( finder ) {

			finder.on( 'files:choose', function( evt ) {

				if(type == 'MULTIPLE'){
					var files = evt.data.files;

				    var html = '', url_file;
				    var value = $(in_value).val() ? $(in_value).val()+',' : '' ;
				    files.forEach( function( file, i ) {
						url_file = file.getUrl().replace(urlHome, ''); 
				    	html += `<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mt-3">
                                    <span data-route="0" data-url="${url_file}" class="delete-file-ckfinder">
                                        <i class="ti ti-x"></i>
                                    </span>
                                    <img src="${file.getUrl()}" width="100%">
                                </div>`;
						if(i < files.length - 1){
							value += url_file + ',';
						}else{
							value += url_file;
						}
				    } );
				    $(preview).append(html);
				    $(in_value).val(value);
				}
				else{
                    var file = evt.data.files.first();
					$(preview).attr('src', file.getUrl());
					$(in_value).val(file.getUrl().replace(urlHome, ''));
				}
			} );
		}
		
	} );
	
}

function selectFileCKFinder( preview, in_value, type ) {
	CKFinder.popup( {
		chooseFiles: true,
		width: 800,
		height: 600,
		onInit: function( finder ) {

			finder.on( 'files:choose', function( evt ) {

				if(type == 'MULTIPLE'){
					var files = evt.data.files;

				    var html = '';
				    var value = $(in_value).val() ? $(in_value).val()+',' : '' ;

				    files.forEach( function( file, i ) {

						var path_file = file.getUrl().replace(urlHome, ''); 

						var url;

						var extensionFile = path_file.split('.').pop();

						var nameFile = path_file.split('/').pop();

						if(extensionFile == 'png' || extensionFile == 'jpg' || extensionFile == 'jpeg')
						{
							url = file.getUrl();
						}else {
							url = urlHome + '/public/admins/assets/images/icon-' + path_file.split('.').pop() + '.png';
						}

						html += `<div class="col-md-4 col-6 mt-3 mb-3">
                                    <span data-route="0" data-url="${path_file}" class="delete-file-ckfinder">
                                        <i class="ti ti-x"></i>
                                    </span>
                                    <img src="${url}" onerror="this.src='${urlHome + '/public/admins/assets/images/icon-image.png'}'" width="100%">
									<div class="text-center"><a href="${file.getUrl()}" target="_blank">${nameFile}</a></div>
                                </div>`;
						
						if(i < files.length - 1){
							value += path_file + ',';
						}else{
							value += path_file;
						}
				    } );
					$(preview).append(html);
				    $(in_value).val(value);
				}
				else{
                    var file = evt.data.files.first();
					// $(preview).attr('src', file.getUrl());
                	$(in_value).val(file.getUrl().replace(urlHome, '')).trigger("change");
				}
			} );
		}
		
	} );
}

function deleteItemCkfinder(that, input) {
	var url = that.data('url'), 
		url_file = input.val().replace(url, ''); 
        
	if(url_file.indexOf(',,') !== -1) {
		url_file = url_file.replace(',,', ',');	
	}
	if(url_file.indexOf(',') == 0) {
		url_file = url_file.slice(1);	
	}
	if(url_file.lastIndexOf(',') == url_file.length - 1) {
		url_file = url_file.slice(0, -1);	
	}
	input.val(url_file);

}

function deleteItemCkfinder(that, input) {
	var url = that.data('url'), 
		url_file = input.val().replace(url, ''); 
        
	if(url_file.indexOf(',,') !== -1) {
		url_file = url_file.replace(',,', ',');	
	}
	if(url_file.indexOf(',') == 0) {
		url_file = url_file.slice(1);	
	}
	if(url_file.lastIndexOf(',') == url_file.length - 1) {
		url_file = url_file.slice(0, -1);	
	}
	input.val(url_file);
}

$(document).on('click', '.add-image-ckfinder', function(e){
    selectImageCKFinder($(this).data('preview'), $(this).data('input'), $(this).data('type'));
});

$(document).on('click', '.add-files-ckfinder', function(e){
    selectFileCKFinder($(this).data('preview'), $(this).data('input'), $(this).data('type'));
});

$(document).on('click', '.delete-file-ckfinder', function (e) {
    if (!confirm(window.__trans('alertConfirm'))) {
        return;
    }
    var that = $(this),
        input = $(that.parents('.wrap-ckfinder-multiple').find('input'));

    deleteItemCkfinder(that, input);

    that.parent().remove();
});