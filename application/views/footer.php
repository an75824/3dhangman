<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

</div> <!-- end of container -->

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type = 'text/javascript'>
$(document).ready(function() {
	$('.submit_form').click(function (e) {
event.preventDefault();
		var choice = $('#user_input').val();
//		alert($choice);
$.ajax({
type: "POST",
url: "<?= base_url(); ?>" + "game/userChoice",
dataType: 'json',
data: {choice:choice},
success: function(res) {
if (res)
{
//replace image div
}
}
});
	}); //end of submit_form click
}); //end of document ready function
</script>
</body>
</html>
