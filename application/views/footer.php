<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

</div> <!-- end of container -->

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type = 'text/javascript'>
$(document).ready(function() {
	$('.submit_form').click(function(e) {
		var hostname = $(location).attr('host'); //not in use
		var choice = $('#user_input').val();
		if (choice.length > 0) {
			$.ajax({
				type: "POST",
				url: "/3dhangman/game/userChoice",
				//dataType: 'json',
				data: {choice:choice},
				success: function(result) {
					if (result) {
						$('#user_input').val('');
						$( '#hang_image' ).attr("src","assets/img/level1.png");
						$('.word').html(result);
						console.log(result);
					}
				}
			});//end fo ajax
		} //end of input check
	}); //end of submit_form click
}); //end of document ready function

</script>
</body>
</html>
