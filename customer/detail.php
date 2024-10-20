<?php
include_once("connectdb.php");

// ดึงข้อมูลสินค้าที่ต้องการจากตาราง product
$sql1 = "SELECT * FROM product WHERE p_id='{$_GET['pid']}'";
$rs1 = mysqli_query($conn, $sql1);
$data1 = mysqli_fetch_array($rs1);
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>Shine Cosmetic - ดูรายละเอียดสินค้า</title>
    <!-- เพิ่ม Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FADADD; /* สีชมพูนม */
        }
        .card {
            border-radius: 15px; /* ทำมุมกรอบให้โค้งมน */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* เพิ่มเงาให้กรอบ */
        }
        .btn-custom {
            background-color: #FFF8DC; /* สีครีม */
            color: black; /* สีข้อความ */
            border: none; /* ลบเส้นขอบ */
        }
        .btn-custom:hover {
            background-color: #f7e7bf; /* สีครีมเข้มขึ้นเมื่อ hover */
        }
        .card-custom {
            width: 80%; /* กำหนดความกว้างของกรอบ */
            margin: 0 auto; /* จัดให้อยู่ตรงกลาง */
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10"> <!-- ขยายความกว้างของกรอบ -->
                <!-- กล่องที่ครอบทุกอย่างไว้ (มีขอบ) -->
                <div class="card card-custom">
                    <div class="card-body">
                        

                        <!-- ฟอร์มดูข้อมูลสินค้า (readonly) -->
                        <form>
                            <div class="form-group text-center">
                                <h1><input type="text" class="form-control text-center" id="p_name" name="p_name" readonly value="<?=$data1['p_name'];?>"></h1>
                            </div>
                            
                            <div class="text-center mb-3">
                                <img src="images/<?=$data1['p_id'];?>.<?=$data1['p_picture'];?>" width="400" height="400" class="img-fluid rounded">
                            </div>

                           <div class="form-group">
                               <center><input type="text" class="form-control text-center" id="p_price" name="p_price" readonly value="ราคา <?=$data1['p_price'];?> บาท"></center>
                           </div>

                            <div class="form-group">
                                <textarea class="form-control" id="p_detail" name="p_detail" rows="5" readonly><?=$data1['p_detail'];?></textarea>
                            </div>

                            <!-- ปุ่มที่อยู่ตรงกลางและเป็นสีครีม -->
                            <div class="text-center">
                                <a href="type.php" class="btn btn-custom mt-4">กลับไปหน้าสินค้า</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- เพิ่ม Bootstrap JS และ jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
