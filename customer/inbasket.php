<?php
error_reporting(E_NOTICE);
@session_start();
include_once("connectdb.php");
@$kw = $_POST['search'];
$sql ="select * from product where p_id='{$_GET['id']}' ";
$rs = mysqli_query($conn, $sql) ;
$data = mysqli_fetch_array($rs);
$id = $_GET['id'] ;
if(isset($_GET['id'])) {
$_SESSION['sid'][$id] = $data['p_id'];
$_SESSION['sname'][$id] = $data['p_name'];
$_SESSION['sprice'][$id] = $data['p_price'];
$_SESSION['sdetail'][$id] = $data['p_detail'];
$_SESSION['spicture'][$id] = $data['p_picture'];
@$_SESSION['sitem'][$id]++;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>สินค้าในรถเข็น</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/customer/dataTables.dataTables.css" />
 
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
 <style type="text/css">
 body {
background-image: url(Home%20.jpg);
height: 100%;
margin: 0px;
background-repeat: no-repeat;
background-size: cover;
}
 body,td,th {
font-size: medium;
font-family: Arial, Helvetica, sans-serif;
}
 </style>
</head>

<body>
 <div class="full-background">
</div>
<blockquote>
<div class="p-3 text-primary-emphasis border border-primary-subtle rounded-3" style="background-color: #ec407a"
 align='center' style='width:100%;'><h2 style="color: white;">สินค้าในรถเข็น</h2></div>
<br>
<center>
</style>
<a href="type.php" class="btn btn-primary" width="200px">กลับไปเลือกสินค้า</a> 
<?php
if(empty($_SESSION['sid'])) {
?>
<a href="#" class="btn btn-sm btn-danger" width="200px" onClick="alert('ไม่มีสินค้าในตะกร้า');">ลบสินค้าทั้งหมด</a>
<?php } else { ?>
<a href="cosclear.php?pid" onClick="return confirm('ยืนยันการลบ?');" type="button"class="btn btn-sm btn-danger">ลบสินค้าทั้งหมด</a>
<?php } ?>
<?php
if(empty($_SESSION['sid'])) {
?>
<a href="" class="btn btn-success" onClick="alert('กรุณาเลือกสินค้า');">สั่งซื้อสินค้า</a>
<?php } else { ?>
<a href="cosview_order.php?id" class="btn btn-success">ประวัติการสั่งซื้อ</a>
<a href="recordorder.php?id" class="btn btn-success" type="button" onClick="return confirm('ยืนยันการสั่ง?');">สั่งซื้อสินค้า</a>
	
<?php } ?><br><br></center>
<div class="container border">
<table id="myTable" class="table table-striped table-dark table-hover" style="width:100%">
  <thead>
    <tr>
      <th>รูปสินค้า</th>
      <th>ชื่อสินค้า</th>
      <th>ราคา/ชิ้น</th>
      <th>จำนวน(ชิ้น)</th>
      <th>รวม</th>
      <th ></th>
      <th></th>
    </tr>
  </thead>
 <tbody>
    <?php
    if (!empty($_SESSION['sid'])) {
        foreach ($_SESSION['sid'] as $pid) {
            // ดึงข้อมูลสินค้าแต่ละตัวจากฐานข้อมูล
            $sql_product = "SELECT * FROM product WHERE p_id='$pid'";
            $rs_product = mysqli_query($conn, $sql_product);
            $data_product = mysqli_fetch_array($rs_product);

            // ตรวจสอบว่ามีข้อมูลสินค้าหรือไม่
            if ($data_product) {
                $img = "images/" . $data_product['p_id'] . "." . $data_product['p_picture'];
                @$i++;
                $sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
                @$total += $sum[$pid];
    ?>
                <tr>
                    <td><img src="<?= $img; ?>" width="200"></td>
                    <td><?= $_SESSION['sname'][$pid]; ?></td>
                    <td><?= number_format($_SESSION['sprice'][$pid], 0); ?></td>
                    <td><?= $_SESSION['sitem'][$pid]; ?></td>
                    <td><?= number_format($sum[$pid], 0); ?></td>
                    <td><a href="cosclear2.php?id=<?= $pid; ?>" class="btn btn-danger">ลบ</a></td>
                    <td></td>
                </tr>
    <?php
            }
        } // end foreach
    ?>
            <tr>
                <td colspan="5" align="right"><strong>รวมทั้งสิ้น</strong> &nbsp; </td>
                <td><strong><?= number_format($total, 0); ?></strong></td>
                <td><strong>บาท</strong></td>
            </tr>
    <?php
    } else {
    ?>
            <tr>
                <td colspan="7" height="50" align="center">ไม่มีสินค้าในตะกร้า</td>
            </tr>
    <?php } // end if ?>
</tbody>
