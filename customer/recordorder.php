<meta charset="utf-8">
<?php
	@session_start();
	include("connectdb.php");
	$sql = "SELECT * FROM orders WHERE oid='{$_GET['id']}'";
$rs = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($rs);
$id = $_GET['id'];
foreach($_SESSION['sid'] as $pid) {
	$sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid] ;
	@$total += $sum[$pid] ;
}

$sql = "insert into `orders` values('', '$total', CURRENT_TIMESTAMP, '0');" ;
mysqli_query($conn, $sql) or die ("insert error") ;
$id = mysqli_insert_id($conn);

foreach($_SESSION['sid'] as $pid) {
$sql2 = "insert into orders_detail values('', '$id', '".$_SESSION['sid'][$pid]."', '".$_SESSION['sitem'][$pid]."');" ;
mysqli_query($conn, $sql2);
}
@session_start();
session_destroy();	
echo "สั่งซื้อสินค้าเรียบร้อย";
echo "<meta http-equiv=\"refresh\" content=\"0;URL=cosclear.php\">";
?>