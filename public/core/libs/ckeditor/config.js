/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
// var domain = window.location.protocol +'//'+ window.location.hostname +':8888/blog';
var domain = jQuery('meta[name="url-home"]').attr('content');
var locale = document.documentElement.getAttribute("lang");

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = locale ? locale : 'vi';
	// config.uiColor = '#AADC6E';

	config.filebrowserBrowseUrl = domain + '/admin/manager-file/duyet';

    config.filebrowserImageBrowseUrl = domain +'/admin/manager-file/duyet?type=Images';

    config.filebrowserFlashBrowseUrl = domain +'/admin/manager-file/duyet?type=Flash';

    config.filebrowserUploadUrl = domain + '/admin/manager-file/ket-noi?command=QuickUpload&type=Files';

    config.filebrowserImageUploadUrl = domain +'/admin/manager-file/ket-noi?command=QuickUpload&type=Images';
     
    config.filebrowserFlashUploadUrl = domain +'/admin/manager-file/ket-noi?command=QuickUpload&type=Files';
	config.height = 300;

    config.removePlugins = 'a11yhelp,about,bidi,blockquote,colordialog,copyformatting,dialogadvtab,div,elementspath,exportpdf,find,floatingspace,forms,horizontalrule,indentblock,magicline,maximize,newpage,pagebreak,pastefromgdocs,pastefromlibreoffice,pastefromword,pastetext,preview,print,removeformat,scayt,selectall,showblocks,showborders,smiley,specialchar,stylescombo,tab,templates,undo,save,language';
};
