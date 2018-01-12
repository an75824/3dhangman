<?php
if (isset($_SESSION['result']))
{
	echo $_SESSION['result'];
}

if (isset($duplicate_char))
{
	echo " found duplicate character: $duplicate_char";
}
?>
