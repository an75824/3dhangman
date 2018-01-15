<?php
?>
<script>
	var img = "assets/img/level"+<?=$_SESSION['img'];?>+".png";
	$("#user_input").attr("disabled", "disabled");
	$( '#hang_image' ).attr("src",img);
	$('.submit_form').remove();
</script>

