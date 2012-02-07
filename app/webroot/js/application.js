$(document).live('pageinit', function(event) {
	$.mobile.ajaxLinksEnabled = false;
    $.extend($.mobile, {
		//ajaxEnabled: false,
		ajaxLinksEnabled: false,
		ajaxFormsEnabled: false
	});
	console && console.log && console.log("Changing .ui-bar-c to .ui-bar-a");
	setTimeout(function(){ 
		$('[role="search"]').removeClass("ui-bar-c");//.addClass("ui-bar-a")
		$('[data-theme="c"]').removeClass("ui-bar-b").addClass("ui-bar-c");
	}, 100);	
});