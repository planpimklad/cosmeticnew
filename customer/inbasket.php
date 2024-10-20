<?php
// Enable error reporting for development purposes (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();  // Start the session

// Include the database connection file
include_once("connectdb.php");

// Retrieve product details based on the ID passed via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query to fetch the product details
    $sql = "SELECT * FROM product WHERE p_id='$id'";
    $rs = mysqli_query($conn, $sql);
    
    if ($rs) {
        $data = mysqli_fetch_array($rs);
        
        // Store product data in session
        $_SESSION['sid'][$id] = $data['p_id'];
        $_SESSION['sname'][$id] = $data['p_name'];
        $_SESSION['sprice'][$id] = $data['p_price'];
        $_SESSION['sdetail'][$id] = $data['p_detail'];
        $_SESSION['spicture'][$id] = $data['p_picture'];
        @$_SESSION['sitem'][$id]++;
    } else {
        echo "Error fetching product: " . mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>สินค้าในรถเข็น</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />
    <style>
        body {
            background-image: url('Home.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            margin: 0;
        }
        body, td, th {
            font-size: medium;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="p-3 text-center text-white" style="background-color: #ec407a;">
        <h2>สินค้าในรถเข็น</h2>
    </div>
    <br>
    <center>
        <a href="type.php" class="btn btn-primary">กลับไปเลือกสินค้า</a>

        <?php if (empty($_SESSION['sid'])) { ?>
            <a href="#" class="btn btn-danger" onClick="alert('ไม่มีสินค้าในตะกร้า');">ลบสินค้าทั้งหมด</a>
        <?php } else { ?>
            <a href="cosclear.php" class="btn btn-danger" onClick="return confirm('ยืนยันการลบ?');">ลบสินค้าทั้งหมด</a>
        <?php } ?>

        <?php if (empty($_SESSION['sid'])) { ?>
            <a href="#" class="btn btn-success" onClick="alert('กรุณาเลือกสินค้า');">สั่งซื้อสินค้า</a>
        <?php } else { ?>
            <a href="recordorder.php?id=<?= $id ?>" class="btn btn-success" onClick="return confirm('ยืนยันการสั่ง?');">สั่งซื้อสินค้า</a>
        <?php } ?>
    </center>
    <br><br>

    <div class="container border">
        <table id="myTable" class="table table-striped table-dark table-hover">
            <thead>
                <tr>
                    <th>รูปสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคา/ชิ้น</th>
                    <th>จำนวน(ชิ้น)</th>
                    <th>รวม</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($_SESSION['sid'])) {
                    $total = 0;
                    foreach ($_SESSION['sid'] as $pid) {
                        // Query to fetch product data from the database
                        $sql_product = "SELECT * FROM product WHERE p_id='$pid'";
                        $rs_product = mysqli_query($conn, $sql_product);
                        $data_product = mysqli_fetch_array($rs_product);

                        if ($data_product) {
                            $img = "images/" . $data_product['p_picture'];
                            $sum = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
                            $total += $sum;
                ?>
                            <tr>
                                <td><img src="<?= $img; ?>" width="200"></td>
                                <td><?= $_SESSION['sname'][$pid]; ?></td>
                                <td><?= number_format($_SESSION['sprice'][$pid], 0); ?></td>
                                <td><?= $_SESSION['sitem'][$pid]; ?></td>
                                <td><?= number_format($sum, 0); ?></td>
                                <td><a href="cosclear2.php?id=<?= $pid; ?>" class="btn btn-danger">ลบ</a></td>
                            </tr>
                <?php
                        }
                    }
                ?>
                    <tr>
                        <td colspan="4" class="text-right"><strong>รวมทั้งสิ้น</strong></td>
                        <td><strong><?= number_format($total, 0); ?></strong></td>
                        <td><strong>บาท</strong></td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td colspan="6" class="text-center">ไม่มีสินค้าในตะกร้า</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.datatables.net/2.1.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
</body>
</html>
