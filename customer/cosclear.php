<?php
	@session_start();

	session_destroy();

	echo "<meta http-equiv=\"refresh\" content=\"2;URL=inbasket.php\">";
	//header("Location: index.php");

?>
<meta charset="utf-8">