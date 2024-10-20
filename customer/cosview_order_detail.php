<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="รายละเอียดใบสั่งซื้อ">
    <meta name="author" content="คุณ">
    <title>รายละเอียดใบสั่งซื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #ec407a;
            margin-top: 20px;
        }
        table {
            background-color: #fff;
            margin-top: 20px;
        }
        td, th {
            text-align: center;
            vertical-align: middle;
        }
        .btn-custom {
            background-color: #ec407a;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #d93670;
        }
        .table thead {
            background-color: #ec407a;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center">รายละเอียดใบสั่งซื้อ เลขที่ <?=$_GET['a'];?></h1>
        <p class="text-center"><a class="btn btn-custom" href="cosview_order.php">กลับหน้าประวัติการสั่งซื้อ &raquo;</a></p>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ที่</th>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา/ชิ้น</th>
                    <th>รวม (บาท)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("connectdb.php");
                    $sql = "SELECT * FROM orders_detail
                            INNER JOIN product ON orders_detail.pid = product.p_id
                            WHERE orders_detail.oid = '".$_GET['a']."' ";
                    $rs = mysqli_query($conn, $sql);
                    $i = 0;
                    $total = 0;
                    while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                        $i++;
                        $sum = $data['p_price'] * $data['item'];
                        $total += $sum;
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td>
                        รหัสสินค้า: <?=$data['p_id'];?><br>
                        ชื่อสินค้า: <?=$data['p_name'];?>
                    </td>
                    <td><?=$data['item'];?></td>
                    <td><?=number_format($data['p_price'], 0);?></td>
                    <td><?=number_format($sum, 0);?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" class="text-right">รวมทั้งสิ้น</td>
                    <td><?=number_format($total, 0);?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
