$(document).live('pageinit', function(event) {
    $.extend($.mobile, {
		ajaxEnabled: false,
		ajaxLinksEnabled: false,
		ajaxFormsEnabled: false
	});
	(function(){
		$('[role="search"]').removeClass("ui-bar-c");//.addClass("ui-bar-a")
		$('[data-theme="c"]').removeClass("ui-bar-b").addClass("ui-bar-c");
	})();
});