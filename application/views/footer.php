<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

</div> <!-- end of container -->

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type = 'text/javascript'>
$(document).ready(function() {

	/* Dont allow forms to submit any data when pressing enter */
	$("form").submit(function(e) {
		e.preventDefault();
	});
	$('.submit_form').click(function(e) {
		var choice = $('#user_input').val();
		if (choice.length == 1) {
			$.ajax({
				type: "POST",
				url: "<?=base_url();?>"+"game/userChoice",
				//dataType: 'json',
				data: {choice:choice},
				success: function(result) {
					if (result) {
						$('.word').html(result);
					}
				}
			});//end fo ajax
		} //end of input check
	}); //end of submit_form click

	$('#submit_full_word').click(function(e) {
		var word = $('#full_word').val();
		$.ajax({
			type: 'POST',
			url: "<?=base_url();?>"+"game/fullWord",
			data: {word:word},
			success : function(result) {
				if (result)
				{
					$('.word').html(result);
				}
			}//end of success
		});//end of ajax
	});//end of submit_full_word click

}); //end of document ready function

</script>
</body>
</html>
