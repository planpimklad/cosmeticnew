<meta charset="utf-8">
<?php
    // เริ่มเซสชัน
    @session_start();
    include("connectdb.php"); // นำเข้าไฟล์เชื่อมต่อฐานข้อมูล

    // คำนวณยอดรวมของสินค้าในตะกร้า
    foreach($_SESSION['sid'] as $pid) {
        // คำนวณราคาสินค้าแต่ละชิ้น (ราคาต่อชิ้น * จำนวน)
        $sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
        @$ototal += $sum[$pid]; // คำนวณยอดรวมทั้งหมด
    }

    // สร้างคำสั่ง SQL เพื่อบันทึกข้อมูลการสั่งซื้อในตาราง orders
    $sql = "INSERT INTO `orders` VALUES('', '$ototal', CURRENT_TIMESTAMP, '0');";
    mysqli_query($conn, $sql) or die ("เกิดข้อผิดพลาดในการบันทึกข้อมูลการสั่งซื้อ"); // ดำเนินการคำสั่ง SQL

    // รับค่า ID ของคำสั่งซื้อที่เพิ่งถูกบันทึก
    $id = mysqli_insert_id($conn);

    // บันทึกรายละเอียดสินค้าที่สั่งซื้อแต่ละรายการในตาราง orders_detail
    foreach($_SESSION['sid'] as $pid) {
        $sql2 = "INSERT INTO orders_detail VALUES('', '$oid', '".$_SESSION['sid'][$pid]."', '".$_SESSION['sitem'][$pid]."');";
        mysqli_query($conn, $sql2); // ดำเนินการคำสั่ง SQL
    }

    // เปลี่ยนเส้นทางไปยังหน้าถัดไป (cosclear.php)
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=cosclear.php\">";
?>
