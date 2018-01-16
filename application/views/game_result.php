<?php
if (isset($_SESSION['result']))
{
	echo $_SESSION['result'];
?>
	<script type='text/javascript'>
		var img = "assets/img/level"+<?=$_SESSION['img'];?>+".png";
		$('#user_input').val('');
		$( '#hang_image' ).attr("src",img);
	</script>
<?php
}

if (isset($duplicate_char))
{
	echo "Found duplicate character: $duplicate_char";
}

if(isset($word_input))
{
?>
	<script type='text/javascript'>
		$('.word_input').html("<b><?=$word_input;?></b> is wrong!");
	</script>
<?php
}

