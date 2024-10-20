<?php
// เชื่อมต่อฐานข้อมูล
include_once("connectdb.php");

// ดึงข้อมูลลูกค้าทั้งหมดจากตาราง customers
$sql = "SELECT * FROM customers ORDER BY cu_id ASC";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Album example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    body {
    background-color: #FDF5E6
    ; /* เปลี่ยนสีพื้นหลังของทั้งหน้า */
    background-repeat: no-repeat;
  }
  .col-lg-4 {
    background-color: #ec407a; /* สีชมพู */
  }
         .navbar, .bg-dark {
        background-color: #ec407a !important; /* สีชมพูสดสำหรับ navbar และพื้นหลัง */
      }
 .navbar-brand, .nav-link, .text-white {
        color: #FFFFFF !important; /* ตัวอักษรใน navbar เป็นสีขาว */
      }
        .btn-secondary {
        background-color: #ec407a; /* ปุ่มเป็นสีชมพูอ่อน */
        border-color: #ec407a;
      }
        .text-muted {
        color: #ec407a !important; /* ข้อความตัวเล็กเป็นสีชมพูสด */
      }
         .lead {
        color: #ec407a !important; /* ข้อความหลักเป็นสีชมพูสด */
      }
 .featurette-divider {
        border-top: 5px solid #FFB6C1; /* เส้นแบ่งเป็นสีชมพูอ่อน */
      }

      .col-lg-4 {
        background-color: #FDF5E6; /* พื้นหลังคอลัมน์เป็นสีชมพูอ่อน */
      }
        h1, h2 {
        color: #ec407a; /* สีชมพูสดสำหรับ h1 และ h2 */
      }

      .featurette-heading {
        color: #ec407a !important; /* สีชมพูสดเข้มสำหรับข้อความภายใน featurette */
      }
         .category-button {
        margin: 10px 5px; /* เว้นระยะห่างระหว่างปุ่ม */
    }
         footer {
        background-color: #FDF5E6;
        color: #FFFFFF;
      }
        .heading{color:#ec407a !important; }
        
</style>

</head>
<body>
<table id="myTable" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr><th>แก้ไข</th>
                    <th>ลบ</th>
                    <th>IDลูกค้า</th>
                    <th>ชื่อ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>ที่อยู่</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include_once("connectdb.php");
                $sql = "SELECT * FROM customer cu_id ORDER BY cu_id ASC";
                $rs = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_array($rs)) {
            ?>
                <tr data-category-id="<?=$data['cu_id'];?>">
                    <td><a href="update.php?pid=<?=$data['cu_id'];?>" class="btn btn-warning btn-sm"><i class="bi bi-pen"></i>แก้ไข</a></td>
                    <td><a href="delete.php?pid=<?=$data['cu_id'];?>&ext=<?=$data['cu_phone'];?>" onClick="return confirm('ยืนยันการลบ?');" class="btn btn-danger"><i class="bi bi-trash-fill"></i>ลบ</a></td>
                    
                    <td><?=$data['cu_id'];?></td>
                    <td><?=$data['cu_name'];?></td>
                    <td><?=$data['cu_username'];?></td>
                    <td><?=$data['cu_phone'];?></td>
                    <td><?=$data['cu_address'];?></td>
                </tr>
            <?php
                }
                mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>
    <br><br>
</body>
</html>