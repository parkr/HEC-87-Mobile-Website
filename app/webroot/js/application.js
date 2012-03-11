var HEC = {
	checkin: function(){
		if(document.location.pathname.search("program/view") >= 0){
			console && console.log && console.log("checking in.");
			// send ajax request to check the user in here.
			var dasURL = document.location.href.substring(0, document.location.href.search("program/view")) + "check_ins/check_in/" + document.location.href.substring(document.location.href.search("view/")+5) + ".json";
			var ajaxSettings = {
				url: dasURL,
				dataType: "json",
				type: "POST",
				error: function(jqXHR, textStatus, theErrorThrown){
					console && console.log && console.log(textStatus, theErrorThrown);
					// Show modal?
				},
				success: function(data, textStatus, jqXHR){
					// Disable button and change text
					if(data.success){
						// Disable button & change text of button
						$("#check_in_button span span.ui-btn-text").html(data.message);
						$("#check_in_button").addClass('ui-disabled');
					}else{
						// Goddamned error.
						$("#check_in_button span span.ui-btn-text").html(data.message);
					}
				}
			}
			$.ajax(ajaxSettings);
		}
	},
	hasCheckedIn: function(){
		if(document.location.pathname.search("program/view") >= 0){
			console && console.log && console.log("checking in.");
			// send ajax request to check the user in here.
			var dasURL = document.location.href.substring(0, document.location.href.search("program/view")) + "check_ins/has_checked_in_here/" + document.location.href.substring(document.location.href.search("view/")+5) + ".json";
			var ajaxSettings = {
				url: dasURL,
				dataType: "json",
				type: "POST",
				error: function(jqXHR, textStatus, theErrorThrown){
					console && console.log && console.log(textStatus, theErrorThrown);
					// Show modal?
				},
				success: function(data, textStatus, jqXHR){
					// Disable button and change text
					if(data.success && data.has_checked_in){
						// Disable button & change text of button
						$("#check_in_button span span.ui-btn-text").html(data.message);
						$("#check_in_button").addClass('ui-disabled');
					}else{
						// Goddamned error.
						$("#check_in_button span span.ui-btn-text").html(data.message);
					}
				}
			}
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
	HEC.hasCheckedIn();
});