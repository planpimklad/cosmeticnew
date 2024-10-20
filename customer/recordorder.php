<meta charset="utf-8">
<?php
	@session_start();
	include("connectdb.php");
	
		foreach($_SESSION['sid'] as $pid) {
			$sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid] ;
			@$total += $sum[$pid] ;
		}
		$sql = "INSERT INTO orders (ototal, odate, status) VALUES ('$total', CURRENT_TIMESTAMP, '0')";
		if (mysqli_query($conn, $sql)) {
			$id = mysqli_insert_id($conn);
			foreach ($_SESSION['sid'] as $pid) {
				$sql2 = "INSERT INTO orders_detail (od_id, p_id, quantity) VALUES ('$id', '".$_SESSION['sid'][$pid]."', '".$_SESSION['sitem'][$pid]."')";
				mysqli_query($conn, $sql2);
			}
			echo "<meta http-equiv='refresh' content='0;URL=cosclear.php'>";
		} else {
			echo "Error: " . mysqli_error($conn);
		}
		
?>