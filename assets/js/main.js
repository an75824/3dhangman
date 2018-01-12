$(document).ready(function() {
	$('.submit_form').click(function(e) {
		var hostname = $(location).attr('host'); //not in use
		var choice = $('#user_input').val();
		$.ajax({
			type: "POST",
			url: "/3dhangman/game/userChoice",
			//dataType: 'json',
			data: {choice:choice},
			success: function(res) {
				if (res) {
					//replace image div
				}
			}
		});
	}); //end of submit_form click
}); //end of document ready function

