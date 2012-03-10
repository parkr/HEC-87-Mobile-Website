var HEC = {
	checkin: function(){
		if(document.location.pathname.search("program/view") >= 0){
			console && console.log && console.log("checking in.");
			// send ajax request to check the user in here.
			var dasURL = document.location.href.substring(0, document.location.href.search("program/view")) + "profiles/check_in/" + document.location.href.substring(document.location.href.search("view/")+5);
			var ajaxSettings = {
				url: dasURL,
				dataType: "json",
				type: "POST",
				error: function(jqXHR, textStatus, theErrorThrown){
					console && console.log && console.log(textStatus, theErrorThrown);
					// Show modal?
				},
				success: function(data, textStatus, jqXHR){
					console && console.log && console.log(data);
					// Disable button and change text
				}
			}
			console && console.log && console.log(ajaxSettings);
			$.ajax(ajaxSettings);
		}
	}
}

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
	$("#check_in_button").on("click", HEC.checkin);
});