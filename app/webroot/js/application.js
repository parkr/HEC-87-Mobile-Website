$(document).ready(function() {
	$.mobile.ajaxLinksEnabled = false;
    $.extend($.mobile, {
		ajaxEnabled: false,
		ajaxLinksEnabled: false,
		ajaxFormsEnabled: false
	});
});

$(document).bind("mobileinit", function(){
	$.mobile.ajaxFormsEnabled = false;
	$.mobile.ajaxLinksEnabled = false;
    $.extend($.mobile, {
		ajaxEnabled: false,
		ajaxLinksEnabled: false,
		ajaxFormsEnabled: false
	});
});