<?php
    $host = "localhost" ;
	$usr = "root";
	$pwd = "1478963";
	$db = "cosmeticnew";
 
	$conn = mysqli_connect($host,$usr,$pwd) or die("เชื่อมต่อฐานข้อมูลไม่ได้");
	mysqli_select_db($conn,$db) or die("เลือกฐานข้อมูลไม่ได้");
	mysqli_query($conn,"SET NAMES utf8");
	?>
