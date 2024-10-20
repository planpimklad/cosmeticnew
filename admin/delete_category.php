<?php
if(isset($_GET['cid'])){
	include("connectdb.php");
	$sql = "DELETE FROM product WHERE `category`.`c_id` = '{$_GET['cid']}' ";
	mysqli_query($conn, $sql) ;
	
	unlink($_GET['cid'].".".$_GET['ext']);
	
	echo "<script>";
	echo "window.location='edit_category.php';";
	echo "</script>";
}
?>