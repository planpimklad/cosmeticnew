<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายละเอียดใบสั่งซื้อ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8d9e6; /* Soft pastel pink */
        }

        .container {
            background-color: #fff;
            padding: 30px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #d63384; /* Deep pink */
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table th, .table td {
            vertical-align: middle;
            border: 1px solid #d63384; /* Dark pink border */
        }

        .thead-light {
            background-color: #f1b2c8; /* Light pink header */
            color: #fff;
        }

        .table img {
            width: 80px;
        }

        .btn-primary {
            background-color: #d63384;
            border-color: #d63384;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-primary:hover {
            background-color: #c2185b;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.75rem;
            }

            .table th, .table td {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>รายละเอียดใบสั่งซื้อ เลขที่ <?= htmlspecialchars($_GET['a']); ?></h1>
        <a href="view_order.php" class="btn btn-primary mb-3">
            <i class="bi bi-arrow-left-circle"></i> กลับไปหน้ารายการสั่งซื้อ
        </a>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ที่</th>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา/ชิ้น (บาท)</th>
                    <th>รวม (บาท)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../admin/connectdb.php");
                if (isset($_GET['a'])) {
                    $order_id = htmlspecialchars($_GET['a']);
                } else {
                    echo "<p>ไม่พบหมายเลขใบสั่งซื้อ</p>";
                    exit();
                }
                $sql = "SELECT * FROM orders_detail
                        INNER JOIN product ON orders_detail.pid = product.p_id
                        WHERE orders_detail.oid = '" . mysqli_real_escape_string($conn, $_GET['a']) . "'";
                $rs = mysqli_query($conn, $sql);
                $i = 0;
                $total = 0;
                while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                    $i++;
                    $sum = $data['p_price'] * $data['item'];
                    $total += $sum;
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        รหัสสินค้า: <?= htmlspecialchars($data['p_id']); ?><br>
                        ชื่อสินค้า: <?= htmlspecialchars($data['p_name']); ?>
                    </td>
                    <td><?= htmlspecialchars($data['item']); ?></td>
                    <td><?= number_format($data['p_price'], 0); ?></td>
                    <td><?= number_format($sum, 0); ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3"></td>
                    <td><strong>รวมทั้งสิ้น</strong></td>
                    <td><strong><?= number_format($total, 0); ?> บาท</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
