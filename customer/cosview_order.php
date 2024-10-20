<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="รายการใบสั่งซื้อ">
    <meta name="author" content="คุณ">
    <title>รายการใบสั่งซื้อ</title>
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
        }
        td, th {
            text-align: center;
        }
        .btn-custom {
            background-color: #ec407a;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #d93670;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center">รายการใบสั่งซื้อ</h1>
		
		 <p class="text-center"><a class="btn btn-custom" href="	indexx.php">กลับหน้าหลัก &raquo;</a></p>
        <table class="table table-bordered table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th>&nbsp;</th>
                    <th>เลขที่ใบสั่งซื้อ</th>
                    <th>วันที่</th>
                    <th>ราคารวม</th>
                    <th>ลูกค้า</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("connectdb.php");
                    $sql = "SELECT * FROM `orders` ORDER BY oid DESC";
                    $rs = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                ?>
                <tr>
                    <td><a href="cosview_order_detail.php?a=<?=$data['oid'];?>" class="btn btn-custom">ดูรายละเอียด</a></td>
                    <td><?=$data['oid'];?></td>
                    <td><?=$data['odate'];?></td>
                    <td><?=number_format($data['ototal'], 0);?></td>
                    <td>---</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
