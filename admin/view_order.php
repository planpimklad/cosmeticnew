<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายการใบสั่งซื้อ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #FADADD; /* Light pink background */
        }

        h1 {
            color: #ec407a; /* Deep pink for the heading */
            font-weight: bold;
        }

        .table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #ec407a; /* Pink header */
            color: white;
        }

        .btn-primary {
            background-color: #ec407a;
            border-color: #ec407a;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-primary:hover {
            background-color: #d81b60; /* Darker pink on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        a {
            text-decoration: none;
        }

        .container {
            background-color: #fff;
            border-radius: 12px;
            padding: 30px;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>

<body>
    <div class="container my-5 p-4">
        <h1 class="text-center mb-4">รายการใบสั่งซื้อ</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="type.php" class="btn btn-primary btn-lg">
                <i class="bi bi-arrow-left-circle"></i> กลับไปเลือกสินค้า
            </a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ดูรายละเอียด</th>
                    <th scope="col">เลขที่ใบสั่งซื้อ</th>
                    <th scope="col">วันที่</th>
                    <th scope="col">ราคารวม</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../admin/connectdb.php");
                $sql = "SELECT * FROM orders ORDER BY oid DESC";
                $rs = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                ?>
                <tr>
                    <td><a href="view_order_detail.php?a=<?=$data['oid'];?>" class="btn btn-primary btn-sm">ดูรายละเอียด</a></td>
                    <td><?=$data['oid'];?></td>
                    <td><?=$data['odate'];?></td>
                    <td><?=number_format($data['ototal'], 0);?> บาท</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
