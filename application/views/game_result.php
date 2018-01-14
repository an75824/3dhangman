<?php
if (isset($_SESSION['result']))
{
	echo $_SESSION['result'];
?>
	<script>
		var img = "assets/img/level"+<?=$_SESSION['img'];?>+".png";
		$('#user_input').val('');
		$( '#hang_image' ).attr("src",img);
	</script>
<?php
}

if (isset($duplicate_char))
{
	echo " found duplicate character: $duplicate_char";
}

