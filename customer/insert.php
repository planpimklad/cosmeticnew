<?php
include_once("checklogin.php");
echo $_SESSION['aname'];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ปณิดา พิมพ์กลัด (แพลน)</title>
</head>

<body>
<h1>*Movie eiei* - เพิ่มสินค้า</h1>

<form method="post" action="" enctype="multipart/form-data">
	ชื่อสินค้า <input type="text" name="pname" required autofocus><br>
    รายละเอียดสินค้า<br>
	<textarea name="pdetail" rows="5" cols="50"></textarea><br>
    ราคา <input type="text" name="pprice" required><br>
    รูปภาพ <input type="file" name="pimg"><br>
    ประเภทสินค้า 
    <select name="pcat">
    <?php	
	include_once("connectdb.php");
	$sql2 = "SELECT * FROM `category` ORDER BY c_name ASC ";
	$rs2 = mysqli_query($conn, $sql2) ;
	while ($data2 = mysqli_fetch_array($rs2) ){
	?>
    	<option value="<?=$data2['c_id'];?>"><?=$data2['c_name'];?></option>
    <?php } ?>
    </select>
    <br><br>
    <button type="submit" name="Submit"> เพิ่ม </button>
</form> <hr>

<?php
if(isset($_POST['Submit'])){
	
	//var_dump($_FILES['pimg']['name']); exit;
	$file_name = $_FILES['pimg']['name'] ;
	$ext = substr( $file_name , strpos( $file_name , '.' )+1 ) ;
	
	$sql = "INSERT INTO `product` (`p_id`, `p_name`, `p_detail`, `p_price`, `p_ext`, `c_id`) VALUES (NULL, '{$_POST['pname']}', '{$_POST['pdetail']}', '{$_POST['pprice']}', '{$ext}', '{$_POST['pcat']}') ;";
	mysqli_query($conn, $sql)  or die ("เพิ่มข้อมูลสินค้าไม่ได้");
	$idauto = mysqli_insert_id($conn);
	
	copy($_FILES['pimg']['tmp_name'], "images/".$idauto.".".$ext) ;
	
	echo "<script>";
	echo "alert('เพิ่มข้อมูลสินค้าสำเร็จ');";
	echo "window.location='index.php';";
	echo "</script>";
}
?>



<?php	
	mysqli_close($conn);
?>
</body>
</html>


