<?php
@session_start();
include_once("connectdb.php");

// Assuming user is logged in, retrieve user ID from session
$userId = $_SESSION['cu_id'];

// ดึงประวัติการสั่งซื้อของผู้ใช้
$sql = "
    SELECT o.order_id, o.order_date, od.product_id, od.quantity, od.price AS item_price,
           (od.quantity * od.price) AS total_price, p.p_name, p.p_picture
    FROM orders o
    JOIN orders_detail od ON o.order_id = od.order_id
    JOIN product p ON od.product_id = p.p_id
    WHERE o.customer_id = '$userId'
    ORDER BY o.order_date DESC";

$rs = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>ประวัติการซื้อ</title>
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>
    <h2>ประวัติการสั่งซื้อ</h2>
    <a href="index.php" class="btn btn-primary">กลับไปหน้าหลัก</a>
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>วันที่สั่งซื้อ</th>
                <th>รูปสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ราคา/ชิ้น</th>
                <th>จำนวน</th>
                <th>รวม</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($rs) > 0) {
                while ($row = mysqli_fetch_array($rs)) {
            ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($row['order_date'])); ?></td>
                <td><img src="images/<?= $row['p_picture']; ?>" width="120"></td>
                <td><?= $row['p_name']; ?></td>
                <td><?= number_format($row['item_price'], 0); ?></td>
                <td><?= $row['quantity']; ?></td>
                <td><?= number_format($row['total_price'], 0); ?></td>
            </tr>
            <?php
                }
            } else {
            ?>
            <tr>
                <td colspan="6" align="center">ไม่มีประวัติการซื้อ</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
